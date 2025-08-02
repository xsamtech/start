<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One user for several customer_orders
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * MANY-TO-ONE
     * Several customer_orders for a cart
     */
    public function customer_orders(): HasMany
    {
        return $this->hasMany(CustomerOrder::class);
    }

    /**
     * MANY-TO-ONE
     * Several payments for a cart
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if "cart" has successful "payment"
     * 
     * @return bool
     */
    public function hasSuccessfulPayment(): bool
    {
        return $this->payments()->where('status', 0)->exists();
    }

    /**
     * Total price of ordered products
     *
     * @return float
     */
    public function totalAmount(): float
    {
        return round($this->customer_orders->sum('price_at_that_time'), 2);
    }

    /**
     * Total price of ordered products, converted to user currency
     *
     * @return float
     */
    public function totalConvertedAmount($userCurrency): float
    {
        return $this->customer_orders->sum(function ($order) use ($userCurrency) {
            // Si la devise de l'ordre est la même que celle de l'utilisateur
            if ($order->currency == $userCurrency) {
                return round($order->price_at_that_time, 2);
            }

            // Si les devises sont différentes, on effectue la conversion
            $conversionRate = getExchangeRate($order->currency, $userCurrency);

            // Retourner le prix converti
            return round($order->price_at_that_time * $conversionRate, 2);
        });
    }

    /**
     * Total price of ordered products in period, converted to user currency
     *
     * @return float
     */
    public function totalConvertedAmountInPeriod($userCurrency, $period = 'daily'): float
    {
        // Déterminer la plage de dates en fonction du paramètre $period
        $startDate = Carbon::now();
        $endDate = Carbon::now();

        switch ($period) {
            case 'daily':
                $startDate->startOfDay();
                $endDate->endOfDay();
                break;

            case 'weekly':
                $startDate->startOfWeek();
                $endDate->endOfWeek();
                break;

            case 'monthly':
                $startDate->startOfMonth();
                $endDate->endOfMonth();
                break;

            case 'quarterly':
                $startDate->firstOfQuarter();
                $endDate->lastOfQuarter();
                break;

            case 'biannual':
                if ($startDate->month <= 6) {
                    $startDate->firstOfYear();
                    $endDate->endOfMonth(6);

                } else {
                    $startDate->firstOfMonth(7);
                    $endDate->endOfMonth(12);
                }
                break;

            case 'yearly':
                $startDate->firstOfYear();
                $endDate->endOfYear();
                break;

            default:
                throw new \InvalidArgumentException(__('miscellaneous.public.about.subscribe.period.choose'));
        }

        // Charger la relation customer_orders et filtrer par la période
        $orders = $this->customer_orders()->whereBetween('created_at', [$startDate, $endDate])->get();

        // Vérifier si des commandes existent
        if ($orders->isEmpty()) {
            return 0;
        }

        // Calculer le montant total des commandes converties
        return $orders->sum(function ($order) use ($userCurrency) {
            // Si la devise de l'ordre est la même que celle de l'utilisateur
            if ($order->currency == $userCurrency) {
                return round($order->price_at_that_time, 2);
            }

            // Si les devises sont différentes, on effectue la conversion
            $conversionRate = getExchangeRate($order->currency, $userCurrency);

            // Retourner le prix converti
            return round($order->price_at_that_time * $conversionRate, 2) * $order->quantity;
        });
    }
}
