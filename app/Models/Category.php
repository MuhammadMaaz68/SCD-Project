<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * This model represents a category of books (e.g., Fiction, Science, History).
 * It helps in organizing books into different genres.
 */
class Category extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    /**
     * Get the books for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        // One category can have multiple books
        return $this->hasMany(Book::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
