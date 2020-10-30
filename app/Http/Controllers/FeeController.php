<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
    public function getAll()
    {
        $fee = Fee::all();
        return response()->json($fee);
    }
}
