<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/*
id
ref_no
type
studentno
firstname
middlename
lastname
email
grade
department
strand
dob
place_of_birth
contactno
address
nationality
age
gender
religion
fathername
fatherocc
fathercontact
fatherplace
mothername
motherocc

'mothercontact',
'motherplace',
'guardian_name',
'guardian_contactno',
'guardian_relation',
'last_school_attended',
'last_school_grade_level',
'last_school_date_of_attendance',
'last_school_address',
'last_school_year',
'indigenous',
'learning_modality',
'status',
'validated_by',
'approved_by',
'cancelled_by',
'updated_by',
'remarks',
'created_at',
'school_year',
*/ 
class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollment';
    protected $fillable = ['id',
    'ref_no',
    'type',
    'studentno',
    'firstname',
    'middlename',
    'lastname',
    'email',
    'grade',
    'department',
    'strand',
    'dob',
    'place_of_birth',
    'contactno',
    'address',
    'nationality',
    'age',
    'gender',
    'religion',
    'fathername',
    'fatherocc',
    'fathercontact',
    'fatherplace',
    'mothername',
    'motherocc',
    'mothercontact',
    'motherplace',
    'guardian_name',
    'guardian_contactno',
    'guardian_relation',
    'last_school_attended',
    'last_school_grade_level',
    'last_school_date_of_attendance',
    'last_school_address',
    'last_school_year',
    'indigenous',
    'learning_modality',
    'status',
    'validated_by',
    'approved_by',
    'cancelled_by',
    'updated_by',
    'remarks',
    'created_at',
    'school_year'];
    public $timestamps = false;
}
