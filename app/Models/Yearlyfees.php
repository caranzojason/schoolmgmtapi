<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yearlyfees extends Model
{
    use HasFactory;
    protected $table = 'yearlyfees';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','schoolyearfrom','schoolyearto','departmentId','gradeId','strandId','courseId','semester'];
    // public $timestamps = false;
}
