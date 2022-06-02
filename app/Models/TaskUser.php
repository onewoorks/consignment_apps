<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;

    protected $table = 'kh_task_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'task_id',
        'user_id',
        'remarks',
        'created_by'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
