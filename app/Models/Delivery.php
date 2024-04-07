<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_livraison',
        'adresse_livraison',
        'frais_livraison',
        'id_livreur',
        'id_commande',
        'created_at',
        'updated_at',
    ];
}
