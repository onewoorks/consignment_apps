<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'kh_team_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'team_id',
        'user_id',
        'name',
        'date_joined',
        'role'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
