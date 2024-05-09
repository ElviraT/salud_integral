<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_day',
        'id_medical',
        'start_hour',
        'end_hour'
    ];

    public function medical(): BelongsTo
    {
        return $this->belongsTo(Medical::class, 'id');
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class, 'id');
    }
}
