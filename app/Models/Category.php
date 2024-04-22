<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    protected $guarded = [];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
