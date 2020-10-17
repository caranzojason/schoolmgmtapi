<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentController extends Controller
{
    public function getAll()
    {
        $student = Student::all();
        return response()->json($student);
    }

    public function createStudent(Request $request)
    {

        try {
            $stud = new Student();
            $stud->studentno =  $request->studentno;
            $stud->firstname =  $request->firstname;
            $stud->middlename =  $request->middlename;
            $stud->lastname =  $request->lastname;
            $stud->email =  $request->email;
            $stud->grade =  $request->grade;
            $stud->department =  $request->department;
            $stud->strand =  $request->strand;
            $strDate = $request->dob['year'] . "/" . $request->dob['month'] .'/'. $request->dob['day'];
            $stud->dob =  $strDate;
            $stud->place_of_birth =  $request->place_of_birth;
            $stud->contactno =  $request->contactno;
            $stud->address =  $request->address;
            $stud->nationality =  $request->nationality;
            $stud->age =  $request->age;
            $stud->gender =  $request->gender;
            $stud->religion =  $request->religion;
            $stud->fathername =  $request->fathername;
            $stud->fatherocc =  $request->fatherocc;
            $stud->fathercontact =  $request->fathercontact;
            $stud->fatherplace =  $request->fatherplace;
            $stud->mothername =  $request->mothername;
            $stud->motherocc =  $request->motherocc;
            $stud->mothercontact =  $request->mothercontact;
            $stud->motherplace =  $request->motherplace;
            $stud->guardian_name =  $request->guardian_name;
            $stud->guardian_contactno =  $request->guardian_contactno;
            $stud->guardian_relation =  $request->guardian_relation;
            $stud->status =  "A";//Open
            $stud->semester =  $request->semester;
            $stud->save();
            
            return response()->json($stud , 201);
        } catch (Exception $e) {
            throw new HttpException(200, $e->getMessage());
        }
    }

    public function studentlist($page = 0,$pageSize = 0,$searchField = "")
    {
            $stud = (object) [
                'Student' => [],
                'NoOfRecords' => 0
            ];

            if($searchField != ""){
         
                $student= Student::Where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->skip($page)->take($pageSize)->get();

                $countStudent = Student::where('ref_no','LIKE','%'.$searchField.'%')
                ->Where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $stud->Student = $student;
                $stud->NoOfRecords = $countStudent;
                return response()->json($stud, 200);
            }else{
                $student = Student::skip($page)->take($pageSize)->orderby('lastname')->get();

                $countStudent = Student::Where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $stud->Student = $student;
                $stud->NoOfRecords = $countStudent;
                return response()->json($stud, 200);
            }
    }

    public function studentViewlist($page = 0,$pageSize = 0,$searchField = "")
    {
            $stud = (object) [
                'Student' => [],
                'NoOfRecords' => 0
            ];

            if($searchField != ""){
         
                $student= DB::table("VStudent")->where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->skip($page)->take($pageSize)->get();

                $countStudent = DB::table("VStudent")->where('ref_no','LIKE','%'.$searchField.'%')
                ->Where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $stud->Student = $student;
                $stud->NoOfRecords = $countStudent;
                return response()->json($stud, 200);
            }else{
                $student = DB::table("VStudent")->skip($page)->take($pageSize)->orderby('lastname')->get();

                $countStudent = DB::table("VStudent")->where('lastname','LIKE','%'.$searchField.'%')
                ->orWhere('firstname','LIKE','%'.$searchField.'%')
                ->orWhere('email','LIKE','%'.$searchField.'%')->orderby('lastname')->count();

                $stud->Student = $student;
                $stud->NoOfRecords = $countStudent;
                return response()->json($stud, 200);
            }
    }

    
}
