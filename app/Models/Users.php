<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $table = 'users';
    protected $fillable = ['username','password','firstname','lastname','fullname','email','user_level','status','is_suspended'];
}
