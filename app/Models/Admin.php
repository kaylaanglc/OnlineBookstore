<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id', 'book_id'];

    /**
     * Get the user associated with the admin.
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the order associated with the admin.
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the book associated with the admin.
     */
    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
