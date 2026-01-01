<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * This model represents a book in the library system.
 * It manages book details such as title, author, description, and availability.
 */
class Book extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'category_id', 'description', 'cover_image', 'published_year', 'quantity'
    ];

    /**
     * Get the category that owns the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // One book belongs to one category
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the reviews for the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        // One book can have multiple reviews
        return $this->hasMany(Review::class);
    }
}
