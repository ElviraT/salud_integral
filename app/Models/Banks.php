<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'account',
        'titular',
        'amount',
        'user_id',
    ];
}
