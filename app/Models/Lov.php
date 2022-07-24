<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lov extends Model
{
    use HasFactory;

    protected $table = 'kh_lovs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'lov_category',
        'lov_code',
        'lov_name',
        'description',
        'is_default',
        'is_required',
        'created_by',
        'updated_by',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
