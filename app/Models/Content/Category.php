<?php

namespace App\Models\Content;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use CrudTrait;

    /**
     * @var string
     */
    protected $table = 'content_groups_categories';

    public $timestamps = false;

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function contentsOverview(): HasMany
    {
        return $this->hasMany(Content::class)
            ->where('content_contents.subcategory', '=', 'OVERVIEW');
    }

    public function contentsContent(): HasMany
    {
        return $this->hasMany(Content::class)
            ->where('content_contents.subcategory', '=', 'CONTENT');
    }

    public function contentsReview(): HasMany
    {
        return $this->hasMany(Content::class)
            ->where('content_contents.subcategory', '=', 'REVIEW');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'title'
    ];

}
