<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'student';
    protected $casts = [ 'department' => 'integer'];
    protected $fillable = ['id',
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
    'status',
    'semester'];
}
