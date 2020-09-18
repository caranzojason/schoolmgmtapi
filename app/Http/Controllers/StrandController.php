<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Strand;

class StrandController extends Controller
{
    public function getAll()
    {
        $strand = Strand::all();
        return response()->json($strand);
    }
}
