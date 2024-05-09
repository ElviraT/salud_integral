<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'color'
    ];

    public function limits(): HasMany
    {
        return $this->hasMany(Limit::class, 'status');
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'status');
    }

    public function medical(): HasMany
    {
        return $this->hasMany(Medical::class, 'id_status');
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class, 'id_status');
    }
}
