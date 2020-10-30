<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentFee;
use App\Models\StudentFeeDetail;
use DB;

class StudentFeeController extends Controller
{
    public function saveStudentFee(Request $request)
    {
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

    public function updateStudentFee(Request $request)
    {
      try {
            $studFee = StudentFee::find( $request->id);
            $studFee->remarks = $request->remarks;
            $studFee->status = $request->status;
            $studFee->studentId = $request->studentId;
            $studFee->schoolyearfrom = $request->schoolyearfrom;
            $studFee->schoolyearto = $request->schoolyearto;
            $studFee->save();

            return response()->json([$studFee
            ], 200);
          } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function saveStudentFeeDetail(Request $request)
    {
      foreach($request->all() as $key => $value){
          $studFee = new StudentFeeDetail();
          $studFee->description =  $value['description'];
          $studFee->amount =  $value['amount'];
          $studFee->studentFeeId =  $value['studentFeeId'];
          $studFee->feeType =  $value['feeType'];
          $studFee->save();
      }
      return response()->json(["OK"
      ], 201);
    }

    public function updateStudentFeeDetail(Request $request)
    {
      $id = $request[0]['studentFeeId'];
      $previousDetail = StudentFeeDetail::where('studentFeeId',$id);
      $previousDetail->delete();
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

    public function getIndividualListStudentFee($schoolYearFrom,$schoolYearTo,$page,$pageSize,$searchField = ""){
      $studentFee = (object) [
        'studentFee' => [],
        'NoOfRecords' => 0
      ];

      if($searchField != ""){
          $data = DB::table("VStudentFee")
          ->where( 'LastName','LIKE','%'.$searchField.'%')
          ->orWhere('FirstName','LIKE','%'.$searchField.'%')
          ->orWhere('remarks','LIKE','%'.$searchField.'%')
          ->orWhere('schoolyearfrom','LIKE','%'.$searchField.'%')
          ->orWhere('schoolyearto','LIKE','%'.$searchField.'%')
          ->skip($page)->take($pageSize)->orderby('LastName')->get();

          $countYearlyFee = DB::table("VStudentFee")
          ->where( 'LastName','LIKE','%'.$searchField.'%')
          ->orWhere('FirstName','LIKE','%'.$searchField.'%')
          ->orWhere('remarks','LIKE','%'.$searchField.'%')
          ->orWhere('schoolyearfrom','LIKE','%'.$searchField.'%')
          ->orWhere('schoolyearto','LIKE','%'.$searchField.'%')->count();

          $studentFee->studentFee = $data;
          $studentFee->NoOfRecords = $countYearlyFee;
          return response()->json($studentFee, 200);

          return response()->json($data, 200);
      }else{
          $data = DB::table("VStudentFee")->skip($page)->take($pageSize)->orderby('LastName')->get();
          $countYearlyFee = DB::table("VStudentFee")->count();
          $studentFee->studentFee = $data;
          $studentFee->NoOfRecords = $countYearlyFee;
          return response()->json($studentFee, 200);
      }
    }

    public function getStudentFeeById($id){
      $data = DB::table("VStudentFee")->where('id',$id)->first();
      return response()->json($data
      , 200);
  }

  public function getStudentFeeDetailByMastereId($masterId){
      if (StudentFeeDetail::where('studentFeeId', $masterId)->exists()) {
          $yearlyFee = StudentFeeDetail::where('studentFeeId', $masterId)->get();
          return response()->json($yearlyFee, 200);
        } else {
          return response()->json([
            "message" => "Student Fee ".$masterId."  not found!"
          ], 200);
        }
  }
}
