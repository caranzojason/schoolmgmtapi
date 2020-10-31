<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadRequest;
use App\Models\Enrollment;
use App\Models\EnrollmentPayment;
use App\Models\Users;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Courses;
use App\Models\Strand;
use DB;

class EnrollmentController extends Controller
{
    public function getAll()
    {
        $enrolment = Enrollment::all();
        return response()->json($enrolment);
    }

    public function getByStatus($status)
    {
        $enrollment = Enrollment::where('status', $status)->first();
        return response()->json($enrollment, 200);
    }

    public function getForverification()
    {
        $enrollment = Enrollment::Where('status', '=', 'pending')->orderBy('created_at','DESC')->get();
        return response()->json($enrollment, 200);
    }

    public function getByEnrolRefNo($refNo)
    {
        if (Enrollment::where('ref_no', $refNo)->exists()) {
            $enrollment = Enrollment::where('ref_no', $refNo)->first();
            return response()->json($enrollment, 200);
          } else {
            return response()->json([
                
            ], 200);
          }
    }
 

    public function getEnrolByEnrlNo($enrolNo)
    {
        if (Enrollment::where('id', $enrolNo)->exists()) {
            $enrollment = Enrollment::where('id', $enrolNo)->first();
            return response()->json($enrollment, 200);
          } else {
            return response()->json([
              "message" => "Enroll Number "+$enrolNo+"  not found!"
            ], 200);
          }
    }


    function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()
    
        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
    
        // otherwise, it's valid and can be used
        return $number;
    }
    
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Users::where('username', $number)->exists();
    }


    public function enrol(Request $request)
    {
        try {

            $resp = (object) [
                'ref_no' => "",
                'password' => ""
            ];

            $enroll = new Enrollment();
            $enroll->ref_no = $this->generateBarcodeNumber();
            $enroll->type =  $request->type;
            $enroll->studentno =  $request->studentno;
            $enroll->firstname =  $request->firstname;
            $enroll->middlename =  $request->middlename;
            $enroll->lastname =  $request->lastname;
            $enroll->email =  $request->email;
            $enroll->grade =  $request->grade;
            $enroll->department =  $request->department;
            $enroll->strand =  $request->strand;
            $enroll->courseId =  $request->courseId;
            $strDate = $request->dob['year'] . "/" . $request->dob['month'] .'/'. $request->dob['day'];
            $enroll->dob =  $strDate;
            $enroll->place_of_birth =  $request->place_of_birth;
            $enroll->contactno =  $request->contactno;
            $enroll->address =  $request->address;
            $enroll->nationality =  $request->nationality;
            $enroll->age =  $request->age;
            $enroll->gender =  $request->gender;
            $enroll->religion =  $request->religion;
            $enroll->fathername =  $request->fathername;
            $enroll->fatherocc =  $request->fatherocc;
            $enroll->fathercontact =  $request->fathercontact;
            $enroll->fatherplace =  $request->fatherplace;
            $enroll->mothername =  $request->mothername;
            $enroll->motherocc =  $request->motherocc;
            $enroll->mothercontact =  $request->mothercontact;
            $enroll->motherplace =  $request->motherplace;
            $enroll->guardian_name =  $request->guardian_name;
            $enroll->guardian_contactno =  $request->guardian_contactno;
            $enroll->guardian_relation =  $request->guardian_relation;
            $enroll->last_school_attended =  $request->last_school_attended;
            $enroll->last_school_grade_level =  $request->last_school_grade_level;
            $enroll->last_school_date_of_attendance =  null;// $request->last_school_date_of_attendance;
            $enroll->last_school_address =  $request->last_school_address;
            $enroll->last_school_year =  $request->last_school_year;
            $enroll->indigenous =  $request->indigenous;
            $enroll->learning_modality =  $request->learning_modality;
            $enroll->status =  "pending";//Open
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
            $enroll->schoolyearfrom =  $request->schoolyearfrom;
            $enroll->schoolyearto =  $request->schoolyearto;
            $enroll->semester =  $request->semester;
            $enroll->save();

            $resp->ref_no = $enroll->ref_no;
            $resp->password =  sprintf("%04d", $request->dob['year'] ) . sprintf("%02d", $request->dob['month'] ).  sprintf("%02d", $request->dob['day']) ;
            return response()->json($resp , 201);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }


    public function updateEnrol(Request $request)
    {
        try {
            $enroll = Enrollment::find( $request->id);
            $enroll->ref_no = $request->ref_no;
            $enroll->type =  $request->type;
            $enroll->studentno =  $request->studentno;
            $enroll->firstname =  $request->firstname;
            $enroll->middlename =  $request->middlename;
            $enroll->lastname =  $request->lastname;
            $enroll->email =  $request->email;
            $enroll->grade =  $request->grade;
            $enroll->department =  $request->department;
            $enroll->strand =  $request->strand;
            $strDate = $request->dob['year'] . "/" . $request->dob['month'] .'/'. $request->dob['day'];
            $enroll->dob =  $strDate;
            $enroll->place_of_birth =  $request->place_of_birth;
            $enroll->contactno =  $request->contactno;
            $enroll->address =  $request->address;
            $enroll->nationality =  $request->nationality;
            $enroll->age =  $request->age;
            $enroll->gender =  $request->gender;
            $enroll->religion =  $request->religion;
            $enroll->fathername =  $request->fathername;
            $enroll->fatherocc =  $request->fatherocc;
            $enroll->fathercontact =  $request->fathercontact;
            $enroll->fatherplace =  $request->fatherplace;
            $enroll->mothername =  $request->mothername;
            $enroll->motherocc =  $request->motherocc;
            $enroll->mothercontact =  $request->mothercontact;
            $enroll->motherplace =  $request->motherplace;
            $enroll->guardian_name =  $request->guardian_name;
            $enroll->guardian_contactno =  $request->guardian_contactno;
            $enroll->guardian_relation =  $request->guardian_relation;
            $enroll->last_school_attended =  $request->last_school_attended;
            $enroll->last_school_grade_level =  $request->last_school_grade_level;
            $enroll->last_school_date_of_attendance =  null;// $request->last_school_date_of_attendance;
            $enroll->last_school_address =  $request->last_school_address;
            $enroll->last_school_year =  $request->last_school_year;
            $enroll->indigenous =  $request->indigenous;
            $enroll->learning_modality =  $request->learning_modality;
            $enroll->status =  "pending";//Open
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
            $enroll->save();
            return response()->json([
                "message" => "Succesfully updated"
            ], 201);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function enrolVerify(Request $request)
    {
        try {

            $enroll = Enrollment::find( $request->id);
            $enroll->id = $request->id;
            $enroll->ref_no =$request->ref_no;
            $enroll->type =  $request->type;
            $enroll->studentno =  $request->studentno;
            $enroll->firstname =  $request->firstname;
            $enroll->middlename =  $request->middlename;
            $enroll->lastname =  $request->lastname;
            $enroll->email =  $request->email;
            $enroll->grade =  $request->grade;
            $enroll->department =  $request->department;
            $enroll->strand =  $request->strand;
            $strDate = $request->dob['year'] . "/" . $request->dob['month'] .'/'. $request->dob['day'];
            $enroll->dob =  $strDate;
            $enroll->place_of_birth =  $request->place_of_birth;
            $enroll->contactno =  $request->contactno;
            $enroll->address =  $request->address;
            $enroll->nationality =  $request->nationality;
            $enroll->age =  $request->age;
            $enroll->gender =  $request->gender;
            $enroll->religion =  $request->religion;
            $enroll->fathername =  $request->fathername;
            $enroll->fatherocc =  $request->fatherocc;
            $enroll->fathercontact =  $request->fathercontact;
            $enroll->fatherplace =  $request->fatherplace;
            $enroll->mothername =  $request->mothername;
            $enroll->motherocc =  $request->motherocc;
            $enroll->mothercontact =  $request->mothercontact;
            $enroll->motherplace =  $request->motherplace;
            $enroll->guardian_name =  $request->guardian_name;
            $enroll->guardian_contactno =  $request->guardian_contactno;
            $enroll->guardian_relation =  $request->guardian_relation;
            $enroll->last_school_attended =  $request->last_school_attended;
            $enroll->last_school_grade_level =  $request->last_school_grade_level;
            $enroll->last_school_date_of_attendance =  null;// $request->last_school_date_of_attendance;
            $enroll->last_school_address =  $request->last_school_address;
            $enroll->last_school_year =  $request->last_school_year;
            $enroll->indigenous =  $request->indigenous;
            $enroll->learning_modality =  $request->learning_modality;
            $enroll->status =  "ForPayment";//Verify
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
        
           $enroll->save();
            return response()->json($request, 200);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function updateInquiry(Request $request)
    {
        try {

            $enroll = Enrollment::find( $request->id);
            $enroll->id = $request->id;
            $enroll->ref_no =$request->ref_no;
            $enroll->type =  $request->type;
            $enroll->studentno =  $request->studentno;
            $enroll->firstname =  $request->firstname;
            $enroll->middlename =  $request->middlename;
            $enroll->lastname =  $request->lastname;
            $enroll->email =  $request->email;
            $enroll->grade =  $request->grade;
            $enroll->department =  $request->department;
            $enroll->strand =  $request->strand;
            $strDate = $request->dob['year'] . "/" . $request->dob['month'] .'/'. $request->dob['day'];
            $enroll->dob =  $strDate;
            $enroll->place_of_birth =  $request->place_of_birth;
            $enroll->contactno =  $request->contactno;
            $enroll->address =  $request->address;
            $enroll->nationality =  $request->nationality;
            $enroll->age =  $request->age;
            $enroll->gender =  $request->gender;
            $enroll->religion =  $request->religion;
            $enroll->fathername =  $request->fathername;
            $enroll->fatherocc =  $request->fatherocc;
            $enroll->fathercontact =  $request->fathercontact;
            $enroll->fatherplace =  $request->fatherplace;
            $enroll->mothername =  $request->mothername;
            $enroll->motherocc =  $request->motherocc;
            $enroll->mothercontact =  $request->mothercontact;
            $enroll->motherplace =  $request->motherplace;
            $enroll->guardian_name =  $request->guardian_name;
            $enroll->guardian_contactno =  $request->guardian_contactno;
            $enroll->guardian_relation =  $request->guardian_relation;
            $enroll->last_school_attended =  $request->last_school_attended;
            $enroll->last_school_grade_level =  $request->last_school_grade_level;
            $enroll->last_school_date_of_attendance =  null;// $request->last_school_date_of_attendance;
            $enroll->last_school_address =  $request->last_school_address;
            $enroll->last_school_year =  $request->last_school_year;
            $enroll->indigenous =  $request->indigenous;
            $enroll->learning_modality =  $request->learning_modality;
            $enroll->status = $request->status;
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
        
           $enroll->save();
            return response()->json($request, 200);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function makePayment(Request $request)
    {
        try {
            $isExist = EnrollmentPayment::where('enrollment_ref_no', $request->enrollment_ref_no)->exists();
            if($isExist){
                $enrolPayment = EnrollmentPayment::where('enrollment_ref_no', $request->enrollment_ref_no)->first();
                $enrolPayment->student_name =  $request->student_name;
                $enrolPayment->enrollment_ref_no =  $request->enrollment_ref_no;
                $enrolPayment->method =  $request->method;
                $enrolPayment->amount =  $request->amount;
                $enrolPayment->description =  $request->description;
                $enrolPayment->approval_remarks =  $request->approval_remarks;
                $enrolPayment->approval_status =  $request->approval_status;
                $enrolPayment->status = "ForApproval";
                $enrolPayment->created_at =  $request->created_at;
                $enrolPayment->save();

                $isExistEnrol = Enrollment::where('ref_no', $request->enrollment_ref_no)->where('status','<>','approved')->exists();
                if( $isExistEnrol){
                    $enrollment = Enrollment::where('ref_no', $request->enrollment_ref_no)->where('status','<>','approved')->first();
                    $enrollment->status = 'PaymentForApproval';
                    $enrollment->save();
                }

                return response()->json([
                    "message" => "payment created"
                ], 200);
            }else{
                $enrolPayment = new EnrollmentPayment();
                $enrolPayment->student_name =  $request->student_name;
                $enrolPayment->enrollment_ref_no =  $request->enrollment_ref_no;
                $enrolPayment->method =  $request->method;
                $enrolPayment->amount =  $request->amount;
                $enrolPayment->description =  $request->description;
                $enrolPayment->approval_remarks =  $request->approval_remarks;
                $enrolPayment->approval_status =  $request->approval_status;
                $enrolPayment->status = "ForApproval";
                $enrolPayment->created_at =  $request->created_at;
                $enrolPayment->save();
                return response()->json([
                    "message" => "payment created"
                ], 201);
            }

        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function uploadFile(Request  $request)
    {
        if($request->hasFile('uploads'))
        {
            $file = $request->file('uploads');
            $originalname = $file->getClientOriginalName();
            $path = $file->storeAs('public/'.$request->enrolId, $originalname);

            $enrollmentPayment = EnrollmentPayment::where('enrollment_ref_no', $request->enrolId)->first();
            $enrollmentPayment->filename =  $originalname;
            $enrollmentPayment->attachmentpath = 'storage/' . $request->enrolId . '/' . $originalname;
            $enrollmentPayment->save();
        }        

        return response()->json([
            "message" => "Successfuly uploaded"
        ], 200);
    }

    public function retrieveFile(){
        $pathToFile = storage_path('public/enrollmentpayment/SJCC-ENR-00202/afterlogin.PNG');
        $getContent = file_get_contents($fileSource); // Here cURL can be use.
        file_put_contents( $pathToFile, $getContent ); 
        return response()->download($pathToFile, $fileName, $headers); 
        return response()->json($path , 200);
    }

    public function getPayment($refNo){
        if (EnrollmentPayment::where('enrollment_ref_no', $refNo)->exists()) {
            $enrollmentPayment = EnrollmentPayment::where('enrollment_ref_no', $refNo)->first();
            return response()->json($enrollmentPayment, 200);
          } else {
            return response()->json([], 200);
          }
    }

    public function inquiry($page = 0,$pageSize = 0,$searchField = "")
    {
            $enrol = (object) [
                'Enrollment' => [],
                'NoOfRecords' => 0
            ];

            if($searchField != ""){
         
                $enrollment = Enrollment::where('ref_no','LIKE','%'.$searchField.'%')
                ->orWhere('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->skip($page)->take($pageSize)->get();

                $countEnrol = Enrollment::where('ref_no','LIKE','%'.$searchField.'%')
                ->orWhere('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $enrol->Enrollment = $enrollment;
                $enrol->NoOfRecords = $countEnrol;
                return response()->json($enrol, 200);
            }else{
                $enrollment = Enrollment::skip($page)->take($pageSize)->orderby('ref_no')->get();

                $countEnrol = Enrollment::where('ref_no','LIKE','%'.$searchField.'%')
                ->orWhere('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $enrol->Enrollment = $enrollment;
                $enrol->NoOfRecords = $countEnrol;
                return response()->json($enrol, 200);
            }

    }

    //SJCC-ENR-00222
    public function getPaymentByEnrolRefNo($refNo)
    {
        // return response()->json($refNo);
        if (EnrollmentPayment::where('enrollment_ref_no', $refNo)->exists()) {
            $paymentList = EnrollmentPayment::where('enrollment_ref_no', $refNo)->first();
            return response()->json($paymentList, 200);
          } else {
            return response()->json([
              "message" => "ref_no not found"
            ], 200);
          }
    }

    public function paymentListForApproval($page = 0,$pageSize = 0,$searchField="")
    {
            $payment = (object) [
                'EnrollmentPayment' => [],
                'NoOfRecords' => 0
            ];

            if($searchField != ""){
         
                $paymentList = EnrollmentPayment::where('status','=','ForApproval')
                ->where(function($query) use ($searchField,$page,$pageSize){
                    $query->where('enrollment_ref_no','LIKE','%'.$searchField.'%')
                   ->orWhere('student_name','LIKE','%'.$searchField.'%');
               })->skip($page)->take($pageSize)->orderby('ref_no')->get();
                // ->where('ref_no','LIKE','%'.$searchField.'%')
                // ->orWhere('student_name','LIKE','%'.$searchField.'%')->orderby('lastname')->skip($page)->take($pageSize)->get();

                $countPayment = EnrollmentPayment::where('status','=','ForApproval')
                ->where(function($query) use ($searchField){
                    $query->where('enrollment_ref_no','LIKE','%'.$searchField.'%')
                   ->orWhere('student_name','LIKE','%'.$searchField.'%');
               })->count();

                $payment->EnrollmentPayment = $paymentList;
                $payment->NoOfRecords = $countPayment;
                return response()->json($payment, 200);
            }else{
                $paymentList = EnrollmentPayment::where('approval_status','=',0)->skip($page)->take($pageSize)->orderby('ref_no')->get();

                $countPayment = EnrollmentPayment::where('approval_status','=',0)->count();

                $payment->EnrollmentPayment = $paymentList;
                $payment->NoOfRecords = $countPayment;
                return response()->json($payment, 200);
            }
    }


    public function paymentList($page = 0,$pageSize = 0,$searchField="")
    {
            $payment = (object) [
                'EnrollmentPayment' => [],
                'NoOfRecords' => 0
            ];

            if($searchField != ""){
         
                $paymentList = EnrollmentPayment::where('enrollment_ref_no','LIKE','%'.$searchField.'%')
                ->orWhere('student_name','LIKE','%'.$searchField.'%')->orderby('ref_no')->skip($page)->take($pageSize)->get();

                $countPayment = EnrollmentPayment::where('enrollment_ref_no','LIKE','%'.$searchField.'%')
                ->orWhere('student_name','LIKE','%'.$searchField.'%')->orderby('ref_no')->count();

                $payment->EnrollmentPayment = $paymentList;
                $payment->NoOfRecords = $countPayment;
                return response()->json($payment, 200);
            }else{
                $paymentList = EnrollmentPayment::skip($page)->take($pageSize)->orderby('ref_no')->get();

                $countPayment = EnrollmentPayment::skip($page)->take($pageSize)->orderby('ref_no')->count();

                $payment->EnrollmentPayment = $paymentList;
                $payment->NoOfRecords = $countPayment;
                return response()->json($payment, 200);
            }
    }

    public function approvePayment($refNo){

        try{
            $isExist = EnrollmentPayment::where('enrollment_ref_no', $refNo)->exists();
            if($isExist ){
                $enrollmentPayment = EnrollmentPayment::where('enrollment_ref_no', $refNo)->where('approval_status',0)->first();
                if($enrollmentPayment){
                    $enrollmentPayment->approval_status = 1;
                    $enrollmentPayment->status = "approved";
                    $enrollmentPayment->save();


                    $isExistEnrol = Enrollment::where('ref_no', $refNo)->where('status','<>','approved')->exists();
                    if( $isExistEnrol){
                        $enrollment = Enrollment::where('ref_no', $refNo)->where('status','<>','approved')->first();
                        $enrollment->status = 'approved';
                        $enrollment->save();
                    }

                    return response()->json($enrollmentPayment, 200);
                }
            }
            return response()->json(null, 200);
        } catch (Exception $e) {
            return response()->json(null, 200);
        }
    }

    public function disapprovePayment($refNo){

        $enrollmentPayment = EnrollmentPayment::where('enrollment_ref_no', $refNo)->where('approval_status',0)->first();
        $enrollmentPayment->approval_status = 2;
        $enrollmentPayment->status = "disapproved";
        $enrollmentPayment->save();
        return response()->json($enrollmentPayment, 200);
    }

    public function getEnrolment(Request $request)
    {
        $tempDepartment = "";
        $tempGrade = "";
        $tempCourse = "";
        $tempStrand = "";
        $tempSemester = "";
        $tempGender = "";

        if(count($request->department) == 0){
            $tempDepartment =  Department::get()->pluck('id')->toArray();// implode(',', Department::get()->pluck('id')->toArray());
        }else{
            $tempDepartment = $request->department;
        }

        if(count($request->grade) == 0){
            $tempGrade = Grade::get()->pluck('id')->toArray();// implode(',', Grade::get()->pluck('id')->toArray());
        }else{
            $tempGrade = $request->grade;
        }

        if(count($request->course) == 0){
            $tempCourse = Courses::get()->pluck('id')->toArray(); //implode(',', Courses::get()->pluck('id')->toArray());
        }else{
            $tempCourse = $request->course;
        }

        if(count($request->strand) == 0){
            $tempStrand =  Strand::get()->pluck('id')->toArray();// implode(',', Strand::get()->pluck('id')->toArray());
        }else{
            $tempStrand = $request->strand;
        }

        if(count($request->semester) == 0){
            $tempSemester = [1,2];
        }else{
            $tempSemester = $request->semester;
        }

        if(count($request->gender) == 0){
            $tempGender = ["male","female"];
        }else{
            $tempGender = $request->gender;
        }

        $enrol = DB::table("VEnrollment")->where('schoolyearfrom',$request->schoolyearfrom)
        ->where('schoolyearto',$request->schoolyearto)
        ->when(count($request->department)>0,function($query) use ($tempDepartment){
            return $query->whereIn("VEnrollment.departmentid",$tempDepartment);
        })
        ->when(count($request->grade)>0,function($query) use ($tempGrade){
            return $query->whereIn("VEnrollment.gradeId",$tempGrade);
        })
        ->when(count($request->course)>0,function($query) use ($tempCourse){
            return $query->whereIn("VEnrollment.courseId",$tempCourse);
        })
        ->when(count($request->strand)>0,function($query) use ($tempStrand){
            return $query->whereIn("VEnrollment.strandId",$tempStrand);
        })
        ->when(count($request->semester)>0,function($query) use ($tempSemester){
            return $query->whereIn("VEnrollment.semester",$tempSemester);
        })
        ->when(count($request->gender)>0,function($query) use ($tempGender){
            return $query->whereIn("VEnrollment.gender",$tempGender);
        })
        ->get();


        // $enrol = DB::table("VEnrollment")->where('schoolyearfrom',$request->schoolyearfrom)
        // ->where('schoolyearto',$request->schoolyearto)
        // ->when($request->department != "",function($query) use ($tempDepartment){
        //     return $query->whereIn("VEnrollment.departmentid",explode(',',$tempDepartment));
        // })
        // ->when($request->grade != "",function($query) use ($tempGrade){
        //     return $query->whereIn("VEnrollment.gradeId",explode(',',$tempGrade));
        // })
        // ->when($request->course != "",function($query) use ($tempCourse){
        //     return $query->whereIn("VEnrollment.courseId",explode(',',$tempCourse));
        // })
        // ->when($request->strand != "",function($query) use ($tempStrand){
        //     return $query->whereIn("VEnrollment.strandId",explode(',',$tempStrand));
        // })
        // ->when($request->semester != "",function($query) use ($tempSemester){
        //     return $query->whereIn("VEnrollment.semester",explode(',',$tempSemester));
        // })
        // ->when($request->gender != "",function($query) use ($tempGender){
        //     return $query->whereIn("VEnrollment.gender",explode(',',$tempGender));
        // })
        // ->get();
        return response()->json($enrol, 200);
    }

    public function getEnrolElementary($schoolYearFrom,$schoolYearTo)
    {
        $bill = DB::select('call sproc_enrollelementary(?,?)',[$schoolYearFrom,$schoolYearTo]);
        return response()->json($bill);
    }

    public function getEnroljuniorhigh($schoolYearFrom,$schoolYearTo)
    {
        $bill = DB::select('call sproc_enroljuniohigh(?,?)',[$schoolYearFrom,$schoolYearTo]);
        return response()->json($bill);
    }
    public function getEnrolsenior($schoolYearFrom,$schoolYearTo)
    {
        $bill = DB::select('call sproc_enrollseniorhigh(?,?)',[$schoolYearFrom,$schoolYearTo]);
        return response()->json($bill);
    }
    public function getEnrolcollege($schoolYearFrom,$schoolYearTo)
    {
        $bill = DB::select('call sproc_enrollcollege(?,?)',[$schoolYearFrom,$schoolYearTo]);
        return response()->json($bill);
    }



}

