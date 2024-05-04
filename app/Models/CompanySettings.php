<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'email',
        'country_id',
        'state_id',
        'city_id',
        'site_logo',
        'favicon',
        'company_icon',
        'facebook',
        'instagram',
        'twitter',
        'address2',
        'phone2',
        'description'
    ];
}