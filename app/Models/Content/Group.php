<?php

namespace App\Models\Content;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;
    use CrudTrait;

    /**
     * @var string
     */
    protected $table = 'content_groups';

    public $timestamps = false;

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function contentIds(): array
    {
        $contentIds = [];
        $categories = $this->categories;
        foreach ($categories as $category) {
            $contentIds = array_merge($contentIds, $category->contents->pluck('id')->toArray());
        }

        return $contentIds;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'shortname'
    ];

}
