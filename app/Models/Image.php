<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'emplacemaent',
        'id_product',
        'created_at',
        'updated_at',
    ];
}
