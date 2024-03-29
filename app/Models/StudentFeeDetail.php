<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeDetail extends Model
{
    use HasFactory;
    protected $table = 'student_fee_detail'; 
    protected $primaryKey = 'id';
    protected $fillable = ['id','description','amount','studentFeeId','feeType'];
    public $timestamps = false;
}
