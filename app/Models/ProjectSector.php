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
class ProjectSector extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'project_sectors';

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
    protected $translatable = ['sector_name', 'sector_description'];

    /**
     * MANY-TO-ONE
     * Several categories for a cart
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
