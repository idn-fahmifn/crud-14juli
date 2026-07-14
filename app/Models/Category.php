<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'uuid'
    ];

    // relasi 1 kategori dimiliki banyak barang
    public function item()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

}
