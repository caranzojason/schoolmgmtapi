<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function getAll()
    {
        $grade = Grade::all();
        return response()->json($grade);
    }
}
