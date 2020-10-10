<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentFee;
use App\Models\StudentFeeDetail;

class StudentFeeController extends Controller
{
    public function saveStudentFee(Request $request)
    {
        // try {
          //  $isExist = YearlyFee::where('enrollment_ref_no', $request->enrollment_ref_no)->exists();
          //  if($isExist){ protected $fillable = ['Id','schoolyearfrom','schoolyearto','departmentId','gradeId','strandId','courseId'];
            $studFee = new StudentFee();
            $studFee->remarks = $request->remarks;
            $studFee->status = $request->status;
            $studFee->studentId = $request->studentId;
            $studFee->schoolyearfrom = $request->schoolyearfrom;
            $studFee->schoolyearto = $request->schoolyearto;

        
            $studFee->save();

            return response()->json([$studFee
            ], 201);
    }

    public function saveStudentFeeDetail(Request $request)
    {
            foreach($request->all() as $key => $value){
                $studFee = new StudentFeeDetail();
                $studFee->description =  $value['description'];
                $studFee->amount =  $value['amount'];
                $studFee->studentFeeId =  $value['studentFeeId'];
                $studFee->save();
            }
            return response()->json(["OK"
            ], 201);
    }

    public function getIndividualStudentFee($studentId,$yearFrom,$yearTo)
    {
        if (StudentFee::where('studentId', $studentId)->exists()) {
            $studentFee = StudentFee::where('studentId', $studentId)->where('schoolyearfrom',$yearFrom)->where('schoolyearto',$yearTo)->first();

            $studentFeeDetail = StudentFeeDetail::where('studentFeeId', $studentFee["id"])->get();
            return response()->json($studentFeeDetail, 200);
          } else {
            return response()->json($studentId
            , 404);
          }
    }
}
