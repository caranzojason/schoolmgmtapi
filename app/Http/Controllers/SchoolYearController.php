<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolYear;



class SchoolYearController extends Controller
{
    public function getActiveSchoolYear()
    {
        $schoolYear = SchoolYear::where('status', 'A')->first();
        return response()->json($schoolYear, 200);
    }
}
