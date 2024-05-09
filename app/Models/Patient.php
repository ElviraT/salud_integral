<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_status',
        'id_marital',
        'ocupation'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function marital(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class, 'id_marital');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
