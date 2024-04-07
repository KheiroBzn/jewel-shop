<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'reduction',
        'date_debut',
        'date_fin',        
        'date_fin',
        'prix_achat',
        'ancien_prix_vente',
        'nouveau_prix_vente',
        'id_article',
        'id_image',
        'created_at',
        'updated_at',
    ];
}
