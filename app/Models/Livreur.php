<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_livreur',
        'location_livreur',
        'tel_livreur',
        'tarifs',
        'created_at',
        'updated_at',
    ];
}
