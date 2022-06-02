<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'kh_catalogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_code',
        'branch_code',
        'price_per_unit'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
