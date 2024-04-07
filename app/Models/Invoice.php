<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'montant_HT',
        'montant_TTC',
        'montant_TVA',
        'taux_TVA',
        'id_commande',
        'created_at',
        'updated_at',
    ];
}
