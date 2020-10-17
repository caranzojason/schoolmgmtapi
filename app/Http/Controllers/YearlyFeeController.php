<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yearlyfees;
use App\Models\YearlyFeesDetail;
use DB;

class YearlyFeeController extends Controller
{

    public function getYearlyFeeById($id){
        if (Yearlyfees::where('id', $id)->exists()) {
            $yearlyFee = Yearlyfees::where('id', $id)->first();
            return response()->json($yearlyFee, 200);
          } else {
            return response()->json([
              "message" => "Yearly Fee ".$id."  not found!"
            ], 200);
          }
    }

    public function getYearlyFeeDetailByMastereId($masterId){
        if (YearlyFeesDetail::where('yearlyFeesId', $masterId)->exists()) {
            $yearlyFee = YearlyFeesDetail::where('yearlyFeesId', $masterId)->get();
            return response()->json($yearlyFee, 200);
          } else {
            return response()->json([
              "message" => "Yearly Fee ".$masterId."  not found!"
            ], 200);
          }
    }

    public function saveYearlyFee(Request $request)
    {
            $yearLeeFee = new Yearlyfees();
            $yearLeeFee->schoolyearfrom =  $request->schoolyearfrom;
            $yearLeeFee->schoolyearto =  $request->schoolyearto;
            $yearLeeFee->departmentId =  $request->departmentId;
            $yearLeeFee->gradeId =  $request->gradeId;
            $yearLeeFee->strandId =  $request->strandId;
            $yearLeeFee->courseId =  $request->courseId;
            $yearLeeFee->semester =  $request->semester;
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

    public function updateYearlyFee(Request $request)
    {
        try {
            $yearLeeFee = Yearlyfees::find( $request->Id);
            $yearLeeFee->schoolyearfrom =  $request->schoolyearfrom;
            $yearLeeFee->schoolyearto =  $request->schoolyearto;
            $yearLeeFee->departmentId =  $request->departmentId;
            $yearLeeFee->gradeId =  $request->gradeId;
            $yearLeeFee->strandId =  $request->strandId;
            $yearLeeFee->courseId =  $request->courseId;
            $yearLeeFee->semester =  $request->semester;
            $yearLeeFee->save();

            return response()->json([$yearLeeFee
            ], 201);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function updateYearlyFeeDetail(Request $request)
    {
        $id = $request[0]['yearlyFeesId'];
        $previousDetail = YearlyFeesDetail::where('yearlyFeesId',$id);
        $previousDetail->delete();
    
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


    public function yearlyfee($schoolYearFrom,$schoolYearTo,$page,$pageSize,$searchField = ""){

        $yearlyFee = (object) [
            'yearlyFee' => [],
            'NoOfRecords' => 0
        ];

        if($searchField != ""){
            $data = DB::table("VyearlyFee")
            ->where( 'departmentName','LIKE','%'.$searchField.'%')
            ->orWhere('gradeName','LIKE','%'.$searchField.'%')
            ->orWhere('strandName','LIKE','%'.$searchField.'%')
            ->orWhere('courseName','LIKE','%'.$searchField.'%')
            ->orWhere('schoolyearfrom','LIKE','%'.$searchField.'%')
            ->orWhere('schoolyearto','LIKE','%'.$searchField.'%')
            ->skip($page)->take($pageSize)->orderby('departmentName')->get();

            $countYearlyFee = DB::table("VyearlyFee")
            ->where( 'departmentName','LIKE','%'.$searchField.'%')
            ->orWhere('gradeName','LIKE','%'.$searchField.'%')
            ->orWhere('strandName','LIKE','%'.$searchField.'%')
            ->orWhere('courseName','LIKE','%'.$searchField.'%')
            ->orWhere('schoolyearfrom','LIKE','%'.$searchField.'%')
            ->orWhere('schoolyearto','LIKE','%'.$searchField.'%')->count();

            $yearlyFee->yearlyFee = $data;
            $yearlyFee->NoOfRecords = $countYearlyFee;
            return response()->json($yearlyFee, 200);

            return response()->json($data, 200);
        }else{
            $data = DB::table("VyearlyFee")->skip($page)->take($pageSize)->orderby('departmentName')->get();
            $countYearlyFee = DB::table("VyearlyFee")->count();
            $yearlyFee->yearlyFee = $data;
            $yearlyFee->NoOfRecords = $countYearlyFee;
            return response()->json($yearlyFee, 200);
        }
    }
    
}
