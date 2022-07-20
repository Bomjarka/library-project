<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tag_id
 * @property int $material_id
 */
class MaterialTags extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'material_id'];
}
