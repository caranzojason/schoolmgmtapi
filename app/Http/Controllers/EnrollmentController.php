<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadRequest;
use App\Models\Enrollment;
use App\Models\EnrollmentPayment;
use App\Models\Users;

class EnrollmentController extends Controller
{
    public function getAll()
    {
        $enrolment = Enrollment::all();
        return response()->json($enrolment);
    }

    public function getForverification()
    {
        $enrollment = Enrollment::Where('status', '=', 'verified')->orderBy('created_at','DESC')->get();
        return response()->json($enrollment, 200);
    }

    //http://127.0.0.1:8000/api/enrollmentgetByReff/SJCC-ENR-00001
    public function getByEnrolRefNo($refNo)
    {
        // return response()->json($refNo);
        if (Enrollment::where('ref_no', $refNo)->exists()) {
            $enrollment = Enrollment::where('ref_no', $refNo)->first();
            return response()->json($enrollment, 200);
          } else {
            return response()->json([
              "message" => "ref_no not found"
            ], 404);
          }
    }

    public function getEnrolByEnrlNo($enrolNo)
    {
        // return response()->json($refNo);
        if (Enrollment::where('id', $enrolNo)->exists()) {
            $enrollment = Enrollment::where('id', $enrolNo)->first();
            return response()->json($enrollment, 200);
          } else {
            return response()->json([
              "message" => "Enroll Number "+$enrolNo+"  not found!"
            ], 404);
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
            $enroll->status =  "O";//Open
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
            $enroll->save();
            return response()->json(["message" => "enrollment successfull"
            ], 201);
        } catch (Exception $e) {
            throw new HttpException(500, $e->getMessage());
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
            $enroll->status =  "verified";//Verify
            $enroll->validated_by =  $request->validated_by;
            $enroll->approved_by =  $request->approved_by;
            $enroll->cancelled_by =  $request->cancelled_by;
            $enroll->updated_by =  $request->updated_by;
            $enroll->remarks =  $request->remarks;
            $enroll->created_at =  $request->created_at;
            $enroll->school_year =  $request->school_year;
        
           $enroll->save();

           // Enrollment::whereId( $request->id)->update([$enroll]);
            return response()->json($request, 200);
        } catch (Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
    
    

/* sample json of make payment
        {
        "student_name": "xxxxl",
        "enrollment_ref_no": "SJCC-ENR-00001",
        "method": "Cash",
        "amount": 543.75,
        "description": "Monthly",
        "approval_remarks": "Received the amount of Five Hundred Forty Three Pesos only (Php. 543.00)",
        "approval_status": 1,
        "approval_date": "2020-06-10 13:11:33"
        }
    */
    public function makePayment(Request $request)
    {
        try {
            $enrolPayment = new EnrollmentPayment();
            $enrolPayment->student_name =  $request->student_name;
            $enrolPayment->enrollment_ref_no =  $request->enrollment_ref_no;
            $enrolPayment->method =  $request->method;
            $enrolPayment->amount =  $request->amount;
            $enrolPayment->description =  $request->description;
            $enrolPayment->approval_remarks =  $request->approval_remarks;
            $enrolPayment->approval_status =  $request->approval_status;
            $enrolPayment->created_at =  $request->created_at;
            $enrolPayment->save();
        
            return response()->json([
                "message" => "payment created"
            ], 201);
        } catch (Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    public function uploadFile(Request  $request)
    {

        //$file = $request->file('uploads');
        // return $file->getClientOriginalExtension();
        $uploadFolder = 'images';
        $image = $request->file('uploads');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        // $uploadedImageResponse = array(
        //    "image_name" => basename($image_uploaded_path),
        //    "image_url" => Storage::disk('public')->url($image_uploaded_path),
        //    "mime" => $image->getClientMimeType()
        // );
        

        return response()->json([$image_uploaded_path], 200);
    }


    // public function getEnro()
    // {
    //     $enrolment = Enrollment::all();
    //     return response()->json($enrolment);
    // }y/{page}/{pageSize}/{searchField}


    /*$users = DB::table('users')->skip(10)->take(5)->get();*/
    public function inquiry($page = 0,$pageSize = 0,$searchField = 0)
    {
            // $enrol = {"Enrollment":null,"NoOfRecords":0};

            // $enrol= new stdClass();

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
}

