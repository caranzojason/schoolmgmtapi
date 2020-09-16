<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
'id',
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
'motherocc'
*/
class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    protected $table = 'students';
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
    'motherocc'];

    public $timestamps = false;
}
