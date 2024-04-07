<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'total',
        'etat',
        'choix_livraison',
        'id_client',
        'userid',
        'created_at',
        'updated_at',
    ];
}
