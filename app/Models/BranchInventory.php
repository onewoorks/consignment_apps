<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchInventory extends Model
{
    use HasFactory;

    protected $table = 'kh_branch_inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'branch_code',
        'product_code',
        'quantity',
        'total_price',
        'price_per_unit',
        'created_by',
        'updated_by',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
