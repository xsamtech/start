<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class QuestionAssertion extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'question_assertions';

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
    protected $translatable = ['assertion_content'];

    /**
     * ONE-TO-MANY
     * One project_question for several question_assertions
     */
    public function project_question(): BelongsTo
    {
        return $this->belongsTo(ProjectQuestion::class);
    }
}
