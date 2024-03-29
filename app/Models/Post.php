<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravelista\Comments\Commentable;

class Post extends Model
{
    use HasFactory, Commentable, Notifiable;

    protected $table = 'posts';

    protected $fillable = [
        'image',
        'title',
        'slug',
        'article',
        'status',
        'category_id',
        'user_id',
        'views',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);  
    }
}
