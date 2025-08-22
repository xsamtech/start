<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Crowdfunding extends Model
{
    use HasFactory;

    protected $table = 'crowdfundings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One user for several crowdfundings
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ONE-TO-MANY
     * One product for several crowdfundings
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * MANY-TO-ONE
     * Several paid_funds for a crowdfunding
     */
    public function paid_funds(): HasMany
    {
        return $this->hasMany(PaidFund::class);
    }

    /**
     * MANY-TO-ONE
     * Several notifications for a crowdfunding
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'crowdfunding_id');
    }

    /**
     * Convert expected amount to user currency
     * 
     * @param  string  $userCurrency
     * @return float
     */
    public function convertExpectedAmount($userCurrency): float
    {
        // If the crowdfunding currency and the user currency are the same, no conversion is required.
        if ($this->currency === $userCurrency) {
            return $this->expected_amount;
        }

        // Retrieve the conversion rate between the crowdfunding currency and the user currency
        $conversionRate = getExchangeRate($this->currency, $userCurrency);

        // Calculate the converted amount
        return round($this->expected_amount * $conversionRate, 2);
    }

    /**
     * Déterminer le taux des participations financières
     * 
     * @param  string  $userCurrency
     * @return float
     */
    public function financingRate($userCurrency): float
    {
        // Retrieve the total amount paid, converted to the user's currency
        $totalPaid = $this->totalPaid($userCurrency);

        // Convert the expected amount to the user's currency
        $convertedExpectedAmount = $this->convertExpectedAmount($userCurrency);

        // Calculate the funding percentage
        if ($convertedExpectedAmount > 0) {
            $financingRate = ($totalPaid / $convertedExpectedAmount) * 100;

        } else {
            // If the expected amount is 0 or less (this is impossible in a normal situation), return 0
            $financingRate = 0;
        }

        // Return the percentage rounded to 2 decimal places
        return round($financingRate, 2);
    }

    /**
     * Total des participations financières
     * 
     * @param  string  $userCurrency
     * @return float
     */
    public function totalPaid($userCurrency): float
    {
        // Get all the participations for this crowdfunding
        $paidFunds = PaidFund::where('crowdfunding_id', $this->id)->get();
        // Initialize total
        $totalPaid = 0;

        foreach ($paidFunds as $paidFund) {
            // If the participation currency is the same as the user's, no conversion
            if ($paidFund->currency === $userCurrency) {
                $totalPaid += $paidFund->amount;

            // Otherwise, we convert the amount using the conversion rate
            } else {
                $convertedAmount = $this->convertAmountToUserCurrency($paidFund->amount, $paidFund->currency, $userCurrency);
                $totalPaid += $convertedAmount;
            }
        }

        // Return the rounded sum of the converted amounts
        return round($totalPaid, 2);
    }

    /**
     * Convert any amount from one currency to another
     * 
     * @param  float  $amount
     * @param  string  $fromCurrency
     * @param  string  $toCurrency
     * @return float
     */
    private function convertAmountToUserCurrency($amount, $fromCurrency, $toCurrency)
    {
        // If the currencies are the same, no conversion is needed.
        if ($fromCurrency === $toCurrency) {
            return $amount;
        }

        // Get the conversion rate (assume a helper function for this)
        $conversionRate = getExchangeRate($fromCurrency, $toCurrency);

        // Return the converted amount
        return round($amount * $conversionRate, 2);
    }
}
