<?php

namespace App\Models;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Limit extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'administrativo',
        'medico',
        'asistente',
        'paciente',
        'status',
        'created_at',
        'updated_at',
    ];

    public function Status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
