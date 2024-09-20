<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    public function lmao() {
        return $this->hasMany(ProductVariant::class, 'product_color_id', 'id');
    }
}
