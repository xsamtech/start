<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One cart for several payments
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Scope to filter by month and year
     */
    public function scopeFilterByMonthAndYear($query, $month = null, $year = null)
    {
        $month = $month ?? now()->month; // If month is not provided, use current month
        $year = $year ?? now()->year;   // If year is not provided, use current year

        return $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
    }

    /**
     * Convert order price to user currency
     * 
     * @return float
     */
    public function convertAmountSum($status, $month = null, $year = null): float
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        // Récupérer les paiements pour un statut donné
        $payments = $this->where('status', $status)->filterByMonthAndYear($month, $year)->get();

        // Calculer la somme des montants selon le statut
        $totalAmount = $payments->sum('amount');

        // Si la devise est déjà 'USD', il n'y a pas besoin de conversion
        if ($this->currency === 'USD') {
            return $totalAmount;
        }

        // Récupérer le taux de conversion de la devise actuelle vers USD
        $conversionRate = $this->getExchangeRate($this->currency, 'USD'); // Assure-toi de définir cette méthode ou d'utiliser une API

        // Calculer et retourner le montant converti en USD
        return round($totalAmount * $conversionRate, 2);
    }
}
