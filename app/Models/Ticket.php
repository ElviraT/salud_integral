<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'assigned_name',
        'assigned_due',
        'due_date',
        'image',
        'description',
        'user_id',
        'priority_id',
        'state_id'

    ];
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function statusTicket(): BelongsTo
    {
        return $this->belongsTo(StatusTicket::class, 'state_id');
    }

    public function comment(): HasMany
    {
        return $this->hasMany(Comment::class, 'id_ticket', 'id');
    }
}
