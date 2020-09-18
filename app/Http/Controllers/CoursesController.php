<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;

class CoursesController extends Controller
{
    public function getAll()
    {
        $department = Courses::all();
        return response()->json($department);
    }

    public function getByDeptId($deptId)
    {
        if (Courses::where('department_id', $deptId)->exists()) {
            $courses = Courses::where('department_id', $deptId)->get();
            return response()->json($courses, 200);
          } else {
            return response()->json([
              "message" => "Department Id "+$deptId+"  not found!"
            ], 404);
          }
    }
}
