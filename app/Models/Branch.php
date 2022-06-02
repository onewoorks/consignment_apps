<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'kh_branches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'branch_code',
        'branch_name',
        'state_code',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
