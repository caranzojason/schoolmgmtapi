<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yearlyfees;
use App\Models\YearlyFeesDetail;
class YearlyFeeController extends Controller
{
    public function saveYearlyFee(Request $request)
    {
        // try {
          //  $isExist = YearlyFee::where('enrollment_ref_no', $request->enrollment_ref_no)->exists();
          //  if($isExist){ protected $fillable = ['Id','schoolyearfrom','schoolyearto','departmentId','gradeId','strandId','courseId'];
            $yearLeeFee = new Yearlyfees();
            $yearLeeFee->schoolyearfrom =  $request->schoolyearfrom;
            $yearLeeFee->schoolyearto =  $request->schoolyearto;
            $yearLeeFee->departmentId =  $request->departmentId;
            $yearLeeFee->gradeId =  $request->gradeId;
            $yearLeeFee->strandId =  $request->strandId;
            $yearLeeFee->save();

            return response()->json([$yearLeeFee
            ], 201);
    }

    public function saveYearlyFeeDetail(Request $request)
    {
            foreach($request->all() as $key => $value){
                $yearLeeFee = new YearlyFeesDetail();
                $yearLeeFee->yearlyFeesId =  $value['yearlyFeesId'];
                $yearLeeFee->description =  $value['description'];
                $yearLeeFee->amount =  $value['amount'];
                $yearLeeFee->save();
            }
            return response()->json(["OK"
            ], 201);
    }
    
}
