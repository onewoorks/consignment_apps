<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'kh_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_code',
        'product_name',
        'description',
        'product_category'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
