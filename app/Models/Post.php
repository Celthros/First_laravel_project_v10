<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $quarded = ['id']; // This will allow all fields to be mass assignable
    protected $guarded = [];
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {

        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                    ->orwhere('body', 'like', '%' . $search . '%')
            )
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query
                ->whereHas(
                    'category',
                    fn ($query) =>
                    $query->where('slug', $category)
                )
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query
                ->whereHas(
                    'author',
                    fn ($query) =>
                    $query->where('username', $author)
                )
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // create a public function for thumbnail and detect if the post has a thumbnail or not. if not return a default image
    public function thumbnail()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return "/images/illustration-1.png";
    }

    public function featuredThumbnail()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return "/images/illustration-3.png";
    }
}
