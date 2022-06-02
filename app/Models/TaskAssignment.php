<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;

    protected $table = 'kh_task_assignments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'task_id',
        'sequence',
        'status',
        'start_time',
        'end_time',
        'shop_id',
        'shop_status',
        'shop_image',
        'remarks'
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;
}
