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
use App\Models\Transaction;
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

    public function getYearlyFeeAccordingtoStudent($departmentId=0,$gradeId=0,$strandId=0,$courseId=0,$semester=0,$schoolyearfrom=0,$schoolyearto=0)
    {
        $yearlyFee = Yearlyfees::where('departmentId', $departmentId)
         ->where('gradeId',$gradeId)->where('strandId',$strandId)->where('courseId',$courseId)
         ->where('semester',$semester)->where('schoolyearfrom',$schoolyearfrom)
         ->where('schoolyearto',$schoolyearto)->first();

         if($yearlyFee!=null){
            $yearlyFeeDetail = YearlyFeesDetail::where('yearlyFeesId', $yearlyFee->Id)->get();
            return response()->json($yearlyFeeDetail);
         }else{
             return response()->json([]);
         }
    
    }

    public function generateBill($yearFrom,$yearTo)
    {
        Log::info("Request Cycle with Queues Begins");
        GenerateBill::dispatch($yearFrom,$yearTo);
        Log::info("Request Cycle with Queues Ends");
    }

    public function getStudentForPayment($studentId,$yearFrom,$yearTo)
    {
        $billmaster = BillingMaster::where('studentId', $studentId)
         ->where('schoolyearfrom',$yearFrom)->where('schoolyearto',$yearTo)->first();

         $billDetail = BillingDetail::where('billMasterId', $billmaster->Id)->selectRaw('billMasterId,detailNo ,SUM(amount) as amount')
         ->groupBy('billMasterId','detailNo')->get();

        return response()->json($billDetail);
    }

    public function getStudentForPaymentByBillId($billMasterId,$detailNo)
    {
         $billDetail = BillingDetail::where('billMasterId', $billMasterId)->where('detailNo', $detailNo)->get();
        return response()->json($billDetail);
    }

    public function getStudentPaidPayment($studentId,$yearFrom,$yearTo){
        $billmaster = BillingMaster::where('studentId', $studentId)
         ->where('schoolyearfrom',$yearFrom)->where('schoolyearto',$yearTo)->first();

         $transactionDetail = Transaction::where('billMasterId', $billmaster->Id)->selectRaw('id,billDetailNo as detailNo,totalDetailAmountPaid as amount, billMasterId,amountchange')->get();
         return response()->json($transactionDetail);
    }

    public function generatePdf()
    {
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    }

    public function getAssesmentbydetailNo($schoolYearFrom,$schoolYearTo,$detailNo)
    {
        $bill = DB::select('call sproc_billing(?,?,?)',[$schoolYearFrom,$schoolYearTo,$detailNo]);
        return response()->json($bill);
    }
}
