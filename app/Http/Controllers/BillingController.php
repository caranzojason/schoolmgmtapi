<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class BillingController extends Controller
{
    public function getAllFee()
    {
        $classes = Fee::all();
        return response()->json($classes);
    }
}
