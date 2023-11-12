<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "food";
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, "restaurant_id", "id");
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
