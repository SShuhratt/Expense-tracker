<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type'];

    public function incomes()
    {
        return $this->hasMany(\App\Models\Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(\App\Models\Expense::class);
    }

}
