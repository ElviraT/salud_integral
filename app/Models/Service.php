<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'time_aprox',
        'id_speciality'
    ];

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'id_speciality');
    }
}
