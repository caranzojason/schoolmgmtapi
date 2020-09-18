<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'strand';
    protected $fillable = ['id','name'];
}
