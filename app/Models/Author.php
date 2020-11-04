<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
