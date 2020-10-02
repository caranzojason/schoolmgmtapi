<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentPayment extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'enrollment_registration_payments';
    protected $fillable = ['id',
    'ref_no',
    'student_name',
    'enrollment_ref_no',
    'method',
    'amount',
    'description',
    'attachment',
    'approval_remarks',
    'approval_status',
    'approval_by',
    'approval_date',
    'created_at',
    'status'
];
    
    public $timestamps = false;
}
