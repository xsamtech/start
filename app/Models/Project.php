<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
     * MANY-TO-MANY
     * Several users for several projects
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('paid_fund', 'currency');
    }

    /**
     * ONE-TO-MANY
     * One user for several projects
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * MANY-TO-ONE
     * Several project_answers for a project
     */
    public function project_answers(): HasMany
    {
        return $this->hasMany(ProjectAnswer::class, 'project_id');
    }

    /**
     * MANY-TO-ONE
     * Several files for a product
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'project_id');
    }

    /**
     * Get photo files
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(): HasMany
    {
        return $this->hasMany(File::class)->where('file_type', 'photo');
    }

    public function getPhotosList(): Collection
    {
        return $this->photos;
    }

    /**
     * Get video files
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(File::class)->where('file_type', 'video');
    }

    public function getVideosList(): Collection
    {
        return $this->videos;
    }

    /**
     * Get audio files
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function audios(): HasMany
    {
        return $this->hasMany(File::class)->where('file_type', 'audio');
    }

    public function getAudiosList(): Collection
    {
        return $this->audios;
    }

    /**
     * Get document files
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(File::class)->where('file_type', 'document');
    }

    public function getDocumentsList(): Collection
    {
        return $this->documents;
    }

    /**
     * Get sheet files
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sheets(): HasMany
    {
        return $this->hasMany(File::class)->where('file_type', 'sheet');
    }

    public function getSheetsList(): Collection
    {
        return $this->sheets;
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
