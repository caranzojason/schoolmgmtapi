<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\StudentFee;
use App\Models\StudentFeeDetail;
use App\Models\BillingMaster;
use App\Models\BillingDetail;
use DB;

class GenerateBill implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $yearTo;
    private $yearFrom;
    public function __construct($yearFrom,$yearTo)
    {
        $this->yearFrom = $yearFrom;
        $this->yearTo = $yearTo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $studentFee = StudentFee::where('status', 'O')->where('schoolyearfrom',$this->yearFrom)->where('schoolyearto',$this->yearTo)->get();
        DB::beginTransaction();
        try {
            foreach($studentFee as $studFee){
                $studentFeeDetail = StudentFeeDetail::where('studentFeeId', $studFee["id"])->get();
                $bill = new BillingMaster();
                $bill->studentId = $studFee["studentId"];
                $bill->schoolyearfrom = $this->yearFrom;
                $bill->schoolyearto = $this->yearTo;
                $bill->status = "O";
                $bill->save();   

                for($detailNo=1;$detailNo<=10;$detailNo++){
                    foreach($studentFeeDetail as $studDetail){
                        $billDetail = new BillingDetail();
                        $billDetail->billmasterId = $bill->id;
                        $billDetail->detailNo = $detailNo;
                        if($studDetail['amount'] == 0 )
                        {
                            $billDetail->amount = 0;
                        }else{
                            $billDetail->amount = $studDetail['amount'] / 10;
                        }
                 
                        $billDetail->feeType = 0;//todo: do now wat to do
                        $billDetail->save();
                    }
                }

                $studFee->status = "C";
                $studFee->save();
               DB::commit();
                // return response()->json($bill);
        
            }
       
        } catch (\Exception $ex) {
           DB::rollback();
            // return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
