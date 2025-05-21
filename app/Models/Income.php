<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;
    protected $fillable = ['name','amount','date','category_id'];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class)->withDefault([
            'name' => 'Uncategorized or Deleted',
        ]);
    }
}
