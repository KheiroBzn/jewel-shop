<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CcpImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom',
        'emplacement',
        'extention',
        'id_commande',
        'id_client',
        'id_paiement',
        'created_at',
        'updated_at',
    ];


}
