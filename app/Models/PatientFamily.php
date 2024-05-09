<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_patient',
        'id_marital',
        'id_gender',
        'id_relation',
        'name',
        'last_name',
        'dni',
        'birthdate'
    ];

    public function marital(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class, 'id_marital');
    }

    public function relacion(): BelongsTo
    {
        return $this->belongsTo(Relationship::class, 'id_relation');
    }
}
