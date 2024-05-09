<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class, 'id_marital');
    }
    public function family(): HasMany
    {
        return $this->hasMany(PatientFamily::class, 'id_marital');
    }
}
