<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadRequest;
use App\Models\Enrollment;
use App\Models\EnrollmentPayment;

class EnrollmentController extends Controller
{
    public function getAll()
    {
        $enrolment = Enrollment::all();
        return response()->json($enrolment);
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

    /*asmple json of enrolment
{
        "id": 1,
        "ref_no": "SJCC-ENR-00001xxxx",
        "type": null,
        "studentno": "109629090098",
        "firstname": "testxxx",
        "middlename": "Veleña",
        "lastname": "Corral",
        "email": "gracevcorral@yahoo.com",
        "grade": "13",
        "department": "3",
        "strand": "2",
        "dob": "2004-01-17",
        "place_of_birth": "Cavite City",
        "contactno": "5277617",
        "address": "749 Calpo St., san Antonio, Cavite City",
        "nationality": "Fil",
        "age": 16,
        "gender": "male",
        "religion": "Catholic",
        "fathername": "Dennis Earl Corral",
        "fatherocc": "Car rental Owner",
        "fathercontact": 527,
        "fatherplace": "San Antonio Cavite City",
        "mothername": "Ma. Gracia V. Corral",
        "motherocc": "Teacher",
        "mothercontact": 2147483647,
        "motherplace": "Cavite City",
        "guardian_name": "Emma Corral",
        "guardian_contactno": 527,
        "guardian_relation": "Nephew",
        "last_school_attended": "SPNHS",
        "last_school_grade_level": "10",
        "last_school_date_of_attendance": null,
        "last_school_address": "Sangley Pt.,Cavite City",
        "last_school_year": "2019-2020",
        "indigenous": "no",
        "learning_modality": "blend_mode",
        "status": "approved",
        "validated_by": "",
        "approved_by": "0",
        "cancelled_by": "6",
        "updated_by": "",
        "remarks": "Click this link or copy it to your browser to view your the breakdown of fees:\nhttp://sjcc.edu.ph/fees/shs.JPG\n\nIn order to enroll you must pay for the first month with the amount of Php 543.75.\nIf you come to school, your appointment date and time is June 10, 2020 1:00 PM.",
        "created_at": "2020-06-10 08:50:50",
        "school_year": 0
    }
    */

    public function enrol(Request $request)
    {
        try {
            $enroll = new Enrollment();
            $enroll->ref_no = "x1234"; //todo should be the userid during login or enrol
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
        

        return response()->json([$image_uploaded_path
    ], 200);
    }

    
}

