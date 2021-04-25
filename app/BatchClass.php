<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchClass extends Model
{
    public function tutor()
    {
      return $this->belongsTo('App\User');
    }

    public function students()
    {
      return $this->hasMany('App\Student','class_id');
    }

    public function batchattendance()
    {
      return $this->hasMany('App\Attendance','class_id');
    }
}
