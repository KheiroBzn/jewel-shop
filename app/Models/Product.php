<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_product',
        'nom',
        'description',
        'categorie',
        'type',
        'prix_achat',
        'prix_vente',
        'images',
        'stock',
        'id_fournisseur',
        'created_at',
        'updated_at',
    ];
}
