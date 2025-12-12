<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowHistory extends Model
{
    protected $table = 'borrow_history';

    protected $fillable = [
        'user_id', 'book_id', 'borrowed_at', 'returned_at'
    ];
}
