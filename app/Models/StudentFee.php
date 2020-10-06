<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
    protected $table = 'student_fee';
    protected $primaryKey = 'id';
    protected $fillable = ['id','remarks','status','studentId','schoolyearfrom','schoolyearto'];
}
