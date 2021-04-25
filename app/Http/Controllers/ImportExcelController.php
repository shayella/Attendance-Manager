<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\BatchClass;
use App\Student;
use Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Imports\StudentImport;

class ImportExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $batches = BatchClass::all();
      return view('students.importExcel')->with('batches',$batches);
    }

    public function import(Request $request)
    {
      $this->validate($request, [
        'classid' => ['required','string'],
        'excelfile' => ['required','mimes:xls,xlsx'],
      ]);

      $path = $request->file('excelfile');
      $classid = $request->input('classid');

      Excel::import(new StudentImport,$path);

      $students = Student::where('class_id',$classid)->get()->sortByDesc('created_at');
      return redirect('/home')->with(['success'=> 'Students Successfully Imported', 'students'=>$students]);
    }
}
