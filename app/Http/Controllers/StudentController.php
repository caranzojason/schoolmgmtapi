<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getAll()
    {
        $student = Student::all();
        return response()->json($student);
    }

    public function createStudent(Request $request)
    {
        $student = new Student();
        // $student->student_id = $request->student_id;
        $student->studentno = $request->studentno;
        $student->firstname = $request->firstname;
        // $student->middlename = $request->middlename;
        // $student->lastname = $request->lastname;
        // $student->studenttype = $request->studenttype;
        // $student->gender = $request->gender;
        // $student->dob = $request->dob;
        // $student->age = $request->age;
        // $student->genave = $request->genave;
        // $student->religion = $request->religion;
        // $student->nationality = $request->nationality;
        // $student->pob = $request->pob;
        // $student->lastschool = $request->lastschool;
        // $student->lastdate = $request->lastdate;
        // $student->track = $request->track;
        // $student->strand = $request->strand;
        // $student->mothername = $request->mothername;
        // $student->fathername = $request->fathername;
        // $student->motherocc = $request->motherocc;
        // $student->fatherocc = $request->fatherocc;
        // $student->motherplace = $request->motherplace;
        // $student->fatherplace = $request->fatherplace;
        // $student->fathercontact = $request->fathercontact;
        // $student->mothercontact = $request->mothercontact;
        // $student->address = $request->address;
        // $student->class = $request->class;
        // $student->section = $request->section;
        // $student->rship = $request->rship;
        // $student->tel = $request->tel;
        // $student->status = $request->status;
        // $student->route = $request->route;
        // $student->guardian = $request->guardian;
        // $student->lastschoolad = $request->lastschoolad;
        // $student->lastsy = $request->lastsy;
        // $student->images = $request->images;
        // $student->name = $request->name;
        // $student->email = $request->email;

        // return response()->json($student);

        $student->save();
    
        return response()->json([
            "message" => "student record created"
        ], 201);
    }
}
