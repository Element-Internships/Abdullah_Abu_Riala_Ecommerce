<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock_quantity', 'category_id', 'image_path'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favoritedBy()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}

}
