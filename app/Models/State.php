<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'kh_states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'state_code',
        'state_name',
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
