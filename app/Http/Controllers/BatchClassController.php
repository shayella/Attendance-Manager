<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BatchClass;

class BatchClassController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('batch.create');
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
          'batchno' => ['required', 'string', 'max:255'],
          'time' => ['required', 'string'],
          'days' => ['required','string'],
          'sem' => ['required',  'min:1', 'max:6'],
          'sd' =>  ['required', 'string'],
          'ed' =>  ['required', 'string'],
          'course' => ['required', 'string',  'max:255'],
        ]);

        $batch = new BatchClass;
        $batch->batchno = $request->input('batchno');
        $batch->time = $request->input('time');
        $batch->dayofweek = $request->input('days');
        $batch->semester = $request->input('sem');
        $batch->courses = $request->input('course');
        $batch->tutor_id = auth()->user()->id;
        $batch->startdate = $request->input('sd');
        $batch->enddate = $request->input('ed');
        $batch->save();

        return redirect('/home')->with('success', 'Class Addeed Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $batch= BatchClass::find($id);
      //Check if user_id matches the contact's user_id for correct user to edit correct contact
      if(auth()->user()->id !== $batch->tutor_id){
        return redirect('/')->with('error','Unauuthorised access - Cannot delete contact that you did not create');
      }
      else{
        $batch->delete();
        return redirect('/home')->with('success',  "You've successfully deleted class with BatchId " . $batch->id . " .");

    }
  }
}
