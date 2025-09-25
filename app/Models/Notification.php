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
class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One from_user for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * ONE-TO-MANY
     * One to_user for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * ONE-TO-MANY
     * One product for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * ONE-TO-MANY
     * One crowdfunding for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function crowdfunding(): BelongsTo
    {
        return $this->belongsTo(Crowdfunding::class, 'crowdfunding_id');
    }

    /**
     * ONE-TO-MANY
     * One project for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * ONE-TO-MANY
     * One post for several notifications
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * MANY-TO-ONE
     * Several read_notifications for a notification
     */
    public function read_notifications(): HasMany
    {
        return $this->hasMany(ReadNotification::class, 'notification_id');
    }
}
