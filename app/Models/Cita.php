<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected  $fillable = [
        'title',
        'color',
        'start',
        'end',
        'duration',
        'id_medical',
        'id_patient',
        'id_familiar',
        'id_type',
        'id_service',
        'n_seguro',
        'description'
    ];
}
