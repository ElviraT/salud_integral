<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speciality extends Model
{
    use HasFactory;

    public function medical(): HasMany
    {
        return $this->hasMany(Medical::class, 'id_speciality');
    }
    public function service(): HasMany
    {
        return $this->hasMany(Speciality::class, 'id_speciality');
    }
}
