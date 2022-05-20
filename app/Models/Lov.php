<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lov extends Model
{
    protected $table = 'lov';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;
}
