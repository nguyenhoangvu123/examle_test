<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLayout extends Model
{
    use HasFactory;
    protected $table = 'layout_user';
    protected $fillable = [
        "user_id",
        "layout_id",
        "type"
    ];

    
}
