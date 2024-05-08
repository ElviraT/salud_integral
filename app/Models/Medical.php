<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medical extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_status',
        'id_speciality',
        'register',
        'ncolegio'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'id_speciality');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
