<?php

namespace App\Models;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
