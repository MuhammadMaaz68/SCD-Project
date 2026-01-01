<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BorrowHistory
 *
 * This model maintains a historical record of all borrowing activities.
 * It is useful for auditing and analytics purposes.
 */
class BorrowHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrow_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'book_id', 'borrowed_at', 'returned_at'
    ];
}
