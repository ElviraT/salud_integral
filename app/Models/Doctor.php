<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'idSex',
        'idStatus',
        'idMaritalState',
        'idCountry',
        'idState',
        'idCity',
        'idMunicipality',
        'idParish',
        'brithday',
        'register',
        'ncolegio',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id');
    }
}
