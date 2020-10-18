<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;
use App\Models\Yearlyfees;
use App\Models\YearlyFeesDetail;
use App\Models\StudentFee;
use App\Models\StudentFeeDetail;
use App\Models\BillingMaster;
use App\Models\BillingDetail;
use DB;
use App\Jobs\GenerateBill;
use Illuminate\Support\Facades\Log;

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

    public function generateBill($yearFrom,$yearTo)
    {

        Log::info("Request Cycle with Queues Begins");
        GenerateBill::dispatch($yearFrom,$yearTo);
        // $this->dispatch(new GenerateBill($yearFrom,$yearTo));
        Log::info("Request Cycle with Queues Ends");
        // $studentFee = StudentFee::where('status', 'O')->where('schoolyearfrom',$yearFrom)->where('schoolyearto',$yearTo)->get();

        // DB::beginTransaction();
        // try {
        //     foreach($studentFee as $studFee){
        //         $studentFeeDetail = StudentFeeDetail::where('studentFeeId', $studFee["id"])->get();
        //         $bill = new BillingMaster();
        //         $bill->studentId = $studFee["studentId"];
        //         $bill->schoolyearfrom = $yearFrom;
        //         $bill->schoolyearto = $yearTo;
        //         $bill->status = "O";
        //         $bill->save();   

        //         for($detailNo=1;$detailNo<=10;$detailNo++){
        //             foreach($studentFeeDetail as $studDetail){
        //                 $billDetail = new BillingDetail();
        //                 $billDetail->billmasterId = $bill->id;
        //                 $billDetail->detailNo = $detailNo;
        //                 $billDetail->amount = $studDetail['amount'] / 10;
        //                 $billDetail->feeType = $studDetail['feeType'];
        //                 $billDetail->save();
        //             }
        //         }

        //         $studFee->status = "C";
        //         $studFee->save();
        //         DB::commit();
        //         return response()->json($bill);
        
        //     }
       
        // } catch (\Exception $ex) {
        //     DB::rollback();
        //     return response()->json(['error' => $ex->getMessage()], 500);
        // }
    }

    public function generatePdf()
    {
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    }

}
