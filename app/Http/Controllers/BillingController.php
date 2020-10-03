<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Yearlyfees;
use App\Models\YearlyFeesDetail;

class BillingController extends Controller
{
    public function getAllFee()
    {
        $classes = Fee::all();
        return response()->json($classes);
    }


    public function getYearlyFeeAccordingtoStudent($departmentId=0,$gradeId=0,$strandId=0,$semester=0,$schoolyearfrom=0,$schoolyearto=0)
    {
        $yearlyFee = Yearlyfees::where('departmentId', $departmentId)
         ->where('gradeId',$gradeId)->where('strandId',$strandId)
         ->where('semester',$semester)->where('schoolyearfrom',$schoolyearfrom)->where('schoolyearto',$schoolyearto)->first();

         $yearlyFeeDetail = YearlyFeesDetail::where('yearlyFeesId', $yearlyFee->Id)->get();
        //  $yearlyFee = Yearlyfees::where('departmentId', 1)
        //  ->where('gradeId',$gradeId)
        //  ->where('strandId',0)
        //  ->where('semester',0)->where('schoolyearfrom',2020)->where('schoolyearto',2021)->first();
        return response()->json($yearlyFeeDetail);
    }
}
