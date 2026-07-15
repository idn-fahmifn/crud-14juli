<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'uuid', 'category_id', 'item_name', 'price',
        'condition', 'desc', 'image'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


}
