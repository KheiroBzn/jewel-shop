<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_commande',
        'id_bijou',
        'qte',
        'sous_total',
        'prix_unitaire',
        'created_at',
        'updated_at',
    ];
}
