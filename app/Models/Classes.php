<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'class';
    protected $fillable = ['class_id','class_name','category','sy','fee','ba','computer',
                            'speech','reg','lib','med','lab','athlete','guidance','ofee','lms','yearfee','yearcomp','yearspeech','total'];
}
