<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'light_logo',
        'dark_logo',
        'favicon_icon',
        'footer_logo',
        'email',
        'address',
        'phone_number',
        'website_title',
        'footer_description'
    ];
}
