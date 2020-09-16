<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function getAll()
    {
        $classes = Classes::all();
        return response()->json($classes);
    }
}
