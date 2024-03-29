<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    protected $table = 'billing_detail';
    protected $fillable = ['Id','billMasterId','detailNo','feeType','amount'];
    public $timestamps = false;
}
