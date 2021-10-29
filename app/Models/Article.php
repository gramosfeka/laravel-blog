<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'image',
        'body',
        'status',
        'user_id',
        'image',
        'tags',
        'category_id',
        'created_at',
        'slug',
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
