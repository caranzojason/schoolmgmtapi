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
}
