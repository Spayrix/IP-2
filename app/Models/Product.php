<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'image_url', 'category_id'];

    // Belongs to relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}