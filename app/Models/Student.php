<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';
    protected $table = 'students';
    protected $fillable = ['studentno','firstname','middlename','lastname',
    'studenttype','gender','dob','age','genave','religion','nationality',
    'pob','lastschool','lastdate','track','studentno','strand',
    'mothername','fathername','motherocc','fatherocc','motherplace','fatherplace','fathercontact',
    'mothercontact','address','class','section','rship','tel','status','transport',
    'route','guardian','lastschoolad','lastsy','images','studentno','name','email'];

    public $timestamps = false;
}
