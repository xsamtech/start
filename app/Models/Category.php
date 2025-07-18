<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'categories';

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
    protected $translatable = ['category_name', 'category_description'];

    /**
     * MANY-TO-MANY
     * Several products (having "project" type) for several categories
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    /**
     * ONE-TO-MANY
     * One project_sector for several products
     */
    public function project_sector(): BelongsTo
    {
        return $this->belongsTo(ProjectSector::class);
    }

    /**
     * MANY-TO-ONE
     * Several products for a cart
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
