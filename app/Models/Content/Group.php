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
