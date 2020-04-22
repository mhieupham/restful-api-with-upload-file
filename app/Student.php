<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students_data_ajax';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name','last_name','image'];
}
