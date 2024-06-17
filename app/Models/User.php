<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 既存のリレーション
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // 新しい多対多のリレーション
    public function bookmark_articles()
    {
        return $this->belongsToMany(Article::class, 'bookmarks', 'user_id', 'article_id');
    }
    public function likedArticles()
    {
        return $this->belongsToMany(Article::class, 'likes');
    }


    // 新しいメソッド: 特定の記事がブックマークされているか確認
    public function is_bookmark($articleId) {
        return $this->bookmark_articles()->where('article_id', $articleId)->exists();
    }

    // 属性の定義
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
