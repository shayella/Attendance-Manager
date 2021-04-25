<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = ['rollno','name','gender','phone','class_id','email','gname','gemail','gphone'];
    public function batchClass()
    {
      return $this->belongsTo('App\BatchClass','id');
    }

    public function studentattendance()
    {
      return $this->hasMany('App\Attendance','student_id');
    }

}
