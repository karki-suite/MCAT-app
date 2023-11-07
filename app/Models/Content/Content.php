<?php

namespace App\Models\Content;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;
    use CrudTrait;

    /**
     * @var string
     */
    protected $table = 'content_contents';

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get video code for embedding.
     *
     * @return string|null
     */
    public function getVideoCode(): ?string
    {
        parse_str(parse_url($this->link_video, PHP_URL_QUERY), $videoParsed);
        if(isset($videoParsed['v'])) {
            return $videoParsed['v'];
        }
        return null;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'subcategory',
        'tracking',
        'label',
        'link_text',
        'link_video',
        'link_kaplan'
    ];

}
