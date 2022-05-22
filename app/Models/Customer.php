<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'kh_customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'shop_name',
        'region',
        'address',
        'owner',
        'phone_number',
        'latitude',
        'longitude',
        'shop_image',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
