<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    use HasFactory;
    protected $table = "restaurants";
    protected $guarded = ["id"];
    protected $hidden = ["password"];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
