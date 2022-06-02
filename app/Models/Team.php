<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'kh_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'team_name',
        'remarks'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
