<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class ProjectQuestion extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'project_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Translatable attributes.
     *
     * @var array<int, string>
     */
    protected $translatable = ['question_content', 'question_description'];

    /**
     * ONE-TO-MANY
     * One question_part for several project_questions
     */
    public function question_part(): BelongsTo
    {
        return $this->belongsTo(QuestionPart::class, 'question_part_id');
    }

    /**
     * MANY-TO-ONE
     * Several project_answers for a project_question
     */
    public function project_answers(): HasMany
    {
        return $this->hasMany(ProjectAnswer::class, 'project_question_id');
    }

    /**
     * MANY-TO-ONE
     * Several question_assertions for a project_question
     */
    public function question_assertions(): HasMany
    {
        return $this->hasMany(QuestionAssertion::class, 'project_question_id');
    }
}
