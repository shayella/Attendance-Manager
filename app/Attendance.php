<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['class_id','student_id','attendance_date'];

    public function batchClass()
    {
      return $this->belongsTo('App\BatchClass','id');
    }

    public function students()
    {
      return $this->belongsTo('App\Student','id');
    }
}
