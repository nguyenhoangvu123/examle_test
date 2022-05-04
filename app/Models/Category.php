<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'parent_id',
    ];



   public function childCategory() : Hasmany
   {
       return $this->Hasmany(Category::class, 'parent_id')->with('childCategory');
   }
   public function parentCategory() : BelongsTo
   {
       return $this->belongsTo(Category::class, 'parent_id')->where('parent_id', null)->with('parentCategory');
   }
}
