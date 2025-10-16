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
}
