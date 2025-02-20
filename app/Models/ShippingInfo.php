<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number',
        'city_name',
        'postal_code',
    ];
}
