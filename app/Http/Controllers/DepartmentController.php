<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function getAll()
    {
        $department = Department::all();
        return response()->json($department);
    }

    public function coursesgetByDeptId()
    {
        $department = Department::all();
        return response()->json($department);
    }
    
}
