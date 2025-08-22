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
class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

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
     * Several files for a product
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    /**
     * Retrieve all comments associated with this post
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Post::class, 'answered_for');
    }

    /**
     * MANY-TO-ONE
     * Several notifications for a post
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'post_id');
    }

    /**
     * Compter le nombre de commentaires pour ce post
     */
    public function countComments()
    {
        return $this->comments()->count();
    }

    /**
     * Get photo files
     */
    public function photos()
    {
        return $this->files()->where('file_type', 'photo');
    }

    /**
     * Get video files
     */
    public function videos()
    {
        return $this->files()->where('file_type', 'video');
    }

    /**
     * Get audio files
     */
    public function audios()
    {
        return $this->files()->where('file_type', 'audio');
    }

    /**
     * Get document files
     */
    public function documents()
    {
        return $this->files()->where('file_type', 'document');
    }
}
