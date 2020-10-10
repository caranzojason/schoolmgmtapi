<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingMaster extends Model
{
    use HasFactory;
    protected $table = 'billing_master';
    protected $fillable = ['Id','studentId','billTotalAmount','totalPaid','totalBalance','schoolyearfrom','schoolyearto','status','created_at','updated_at'];

}
