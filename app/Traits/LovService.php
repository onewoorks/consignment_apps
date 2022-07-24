<?php

namespace App\Traits;

use App\Models\Lov;

trait LovService
{
    public function getLovByCodeCategory($cdctgry)
    {
        return Lov::where('lov_category', $cdctgry)->get();
    }

    public function getLovNameByCdCtgryAndCode($cdctgry, $code)
    {
        $lov = Lov::where('lov_category', $cdctgry)->where('lov_code', $code)->first();

        return $lov != null ? $lov->lov_name : $code;
    }

    public function getLovCategoryList()
    {
        $lovCategoryList = Lov::select('lov_category')
            ->groupBy('lov_category')
            ->get();

        return $lovCategoryList;
    }
}
