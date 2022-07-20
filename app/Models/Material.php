<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int type_id
 * @property int category_id
 * @property string $name
 * @property string $author
 * @property string description
 * @property $data
 */
class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'category_id',
        'name',
        'author',
        'description',
        'data'
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return mixed
     */
    public function links()
    {
        return json_decode($this->data, 1)['links'];
    }


    public function tags()
    {
        return Tag::whereIn('id', $this->hasMany(MaterialTags::class)->pluck('tag_id'))->get();
    }
}
