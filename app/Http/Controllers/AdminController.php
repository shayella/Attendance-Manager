<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
Use App\Student;
Use App\BatchClass;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
  }

    public function index()
    {
      $total = User::where('role','Faculty')->get()->count();
      $totalS = Student::all()->count();
      $totalC = BatchClass::all()->count();
      $presentStudents = array();
      $batchStudents = array();
      $batches = BatchClass::all();
      foreach ($batches as $batch)
      {
        $students = Student::whereDate('updated_at',Carbon::today())->get();
        $tempbatch = array();
        foreach($students as $student)
        {
          if($student->class_id == $batch->id)
          {
            array_push($batchStudents,$student);
            array_push($tempbatch,$student);

          }
        }
        array_push($presentStudents, count($tempbatch));

      }
      return view('admin.home')->with(['total'=>$total, 'totalS'=> $totalS, 'totalC'=>$totalC,'batches'=>$batches, 'presentStudents'=>$presentStudents]);
    }

    public function allClasses()
    {
      $batches = BatchClass::all()->sortByDesc('created_at');
      return view('admin.classes')->with('batches', $batches);
    }
}
