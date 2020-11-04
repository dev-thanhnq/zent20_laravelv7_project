<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name','slug', 'origin_price', 'sale_price', 'discount_percent', 'author_id', 'content', 'publishing_company_id', 'pages_count', 'status', 'rate'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
