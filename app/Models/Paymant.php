<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymant extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ccp',
        'total',
        'etat',
        'id_commande',
        'id_client',
        'id_image',
        'created_at',
        'updated_at',
    ];
}
