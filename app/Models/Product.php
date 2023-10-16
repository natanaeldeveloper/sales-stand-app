<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_stand_id',
        'name',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class, 'sales_stand_id', 'id');
    }
}
