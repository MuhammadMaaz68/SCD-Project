<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * This model represents a review and rating left by a user for a specific book.
 */
class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'book_id', 'rating', 'comment'];

    /**
     * Get the user who wrote the review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that was reviewed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
