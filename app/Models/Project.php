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
class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One user for several projects
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ONE-TO-MANY
     * One category for several projects
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * MANY-TO-ONE
     * Several project_activities for a project
     */
    public function project_activities(): HasMany
    {
        return $this->hasMany(ProjectActivity::class);
    }

    /**
     * MANY-TO-ONE
     * Several market_segments for a project
     */
    public function market_segments(): HasMany
    {
        return $this->hasMany(MarketSegment::class);
    }

    /**
     * MANY-TO-ONE
     * Several notifications for a project
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'project_id');
    }
}
