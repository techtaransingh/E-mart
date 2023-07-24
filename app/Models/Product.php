<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['title', 'description', 'image', 'category', 'quantity', 'price', 'discount_price'];
    public function getCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category');
    }
}