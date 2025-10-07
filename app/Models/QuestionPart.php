<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class QuestionPart extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'question_parts';

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
    protected $translatable = ['part_name', 'part_description'];

    /**
     * MANY-TO-ONE
     * Several project_questions for a question_part
     */
    public function project_questions(): HasMany
    {
        return $this->hasMany(ProjectQuestion::class, 'question_part_id');
    }
}
