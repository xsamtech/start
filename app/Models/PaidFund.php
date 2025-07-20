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
class PaidFund extends Model
{
    use HasFactory;

    protected $table = 'paid_funds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One user for several paid_funds
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ONE-TO-MANY
     * One crowdfunding for several paid_funds
     */
    public function crowdfunding(): BelongsTo
    {
        return $this->belongsTo(Crowdfunding::class);
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
     * Check if "paid_fund" has successful "payment"
     * 
     * @return bool
     */
    public function hasSuccessfulPayment(): bool
    {
        return $this->payments()->where('status', 0)->exists();
    }

    /**
     * Convert amount to user currency
     */
    public function convertAmount($userCurrency)
    {
        // If the fund currency and the user currency are the same, no conversion is required.
        if ($this->currency === $userCurrency) {
            return $this->amount;
        }

        // Retrieve the conversion rate between the fund currency and the user currency
        $conversionRate = getExchangeRate($this->currency, $userCurrency);

        // Calculate the converted amount
        return round($this->amount * $conversionRate, 2);
    }
}
