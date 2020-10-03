<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $table = 'school_year';
    protected $primaryKey = 'Id';
    protected $fillable = ['Id','yearfrom','yearto','status'];
}
