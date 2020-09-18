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

    public function getGrades($deptId)
    {
        if (Grade::where('department_id', $deptId)->exists()) {
            $grade = Grade::where('department_id', $deptId)->get();
            return response()->json($grade, 200);
          } else {
            return response()->json([
              "message" => "Department Id "+$deptId+"  not found!"
            ], 404);
          }
    }

    
}
