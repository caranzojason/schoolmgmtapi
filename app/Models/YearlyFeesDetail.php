<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyFeesDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'Id';
    protected $table = 'yearlyfees_detail';
    protected $fillable = ['Id','yearlyFeesId','description	','amount'];
    public $timestamps = false;
}
