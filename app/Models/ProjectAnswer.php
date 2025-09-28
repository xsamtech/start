<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class ProjectAnswer extends Model
{
    use HasFactory;

    protected $table = 'project_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * ONE-TO-MANY
     * One project for several project_answers
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * ONE-TO-MANY
     * One project_question for several project_answers
     */
    public function project_question(): BelongsTo
    {
        return $this->belongsTo(ProjectQuestion::class);
    }
}
