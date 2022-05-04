<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Layout extends Model
{
    use HasFactory;
    protected $table = 'layouts';
    protected $fillable = [
        'name',
        'url',
        'avatar',
        'preview',
        'orientation'
    ];
    const TYPE_ORIENTATION = [
         1 => 'portrait',
         2 => 'landscape'
    ];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'category_layout',
            'category_id',
            'layout_id'
        );
    }
}
