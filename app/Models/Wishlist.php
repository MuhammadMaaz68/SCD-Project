<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wishlist
 *
 * This model represents an item in a user's wishlist.
 * Users can save books they are interested in for later.
 */
class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
    ];

    /**
     * Get the user who owns the wishlist item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book associated with the wishlist item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
