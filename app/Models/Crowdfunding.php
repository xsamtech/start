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
        return $this->hasMany(Notification::class);
    }
}
