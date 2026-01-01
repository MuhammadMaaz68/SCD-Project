<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Borrow
 *
 * This model represents a borrowing transaction.
 * It tracks which user borrowed which book, along with dates and status.
 */
class Borrow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'status',
    ];

    /**
     * Get the user who borrowed the book.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Link to the User model
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that was borrowed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        // Link to the Book model
        return $this->belongsTo(Book::class);
    }
}
