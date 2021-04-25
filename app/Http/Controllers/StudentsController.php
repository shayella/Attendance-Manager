<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BatchClass;
use App\Student;
use App\Attendance;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
      $students = Student::paginate(3);
      return view('students.home')->with('students',$students);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batches = BatchClass::all();
        return view('students.create')->with('batches',$batches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'rollno' => ['required', 'string', 'max:255'],
        'classid' => ['required', 'string'],
        'name' => ['required','string'],
        'email' => ['required',  'max:255'],
        'phone' =>  ['required', 'string'],
        'gender' =>  ['required', 'string'],
        'gname' =>  ['required', 'string'],
        'gemail' => ['required', 'string',  'max:255'],
        'gphone' => ['required', 'string',  'max:255'],

      ]);

      $student = new Student;
      $student->rollno = $request->input('rollno');
      $student->class_id = $request->input('classid');
      $student->name = $request->input('name');
      $student->email = $request->input('email');
      $student->phone = $request->input('phone');
      $student->gname = $request->input('gname');
      $student->gemail = $request->input('gemail');
      $student->gender = $request->input('gender');
      $student->gphone = $request->input('gphone');
      $student->save();

      return redirect('/home')->with('success', 'Student Addeed Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $students = Student::where('class_id',$id)->get()->sortByDesc('created_at');
      return view('students.show')->with('students',$students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $students = Student::where('class_id',$id)->get()->sortByDesc('created_at');
      return view('students.attendance')->with('students',$students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('std'))
        {
          $presentStudents = $request->std;
          foreach ($presentStudents as $stdid => $status)
          {
            $currentStud = Student::find($stdid);
            // return $currentStud;

            $attendance = new Attendance;
            $attendance->class_id = $currentStud->class_id;
            $attendance->student_id = $currentStud->id;
            $attendance->attendance_date = date('Y-m-d H-m-s');
            $attendance->save();

            $currentStud->classesAttended++;
            $currentStud->save();
          }

          return redirect('/home')->with('success','Attendance Successfully Recorded');


        }
        else
        {
          return redirect('/home')->with('error',' No Attendance was Recorded');
        }


        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student= Student::find($id);
        //Check if user_id matches the contact's user_id for correct user to edit correct contact
        $student->delete();
        return back()->with('success',  "You've successfully deleted " . $student->name . "student.");
    }

    public function attendance($id)
    {

    }
}
