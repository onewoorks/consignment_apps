<?php

namespace App\Traits;

use App\Models\Lov;

trait LovService {
    public function getLovByCodeCategory($cdctgry){
        return Lov::where('lov_category', $cdctgry)->get();
    }
}
