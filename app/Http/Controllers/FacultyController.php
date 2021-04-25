<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('faculty');
     }

    public function index()
    {
      $tutors = User::where('role','Faculty')->get()->sortByDesc('created_at');
      return view('faculty.show')->with('tutors',$tutors);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $this->validate($data,[
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'phone' => ['required','string', 'min:10','max:10'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          'user_name' => ['required', 'string',  'max:255', 'unique:users'],
        ]);

        User::create([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
           'role' => 'Faculty',
           'phone' =>$data['phone'],
           'user_name'=> $data['user_name'],
       ]);

        return redirect('/admin')->with('success', 'Faculty Member Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tutor = User::find($id);
        return view('faculty.edit')->with('tutor',$tutor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
      $this->validate($data,[
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required','string', 'min:10','max:10'],
        'user_name' => ['required', 'string',  'max:255', 'unique:users'],
      ]);

      $user= User::find($id);
      $user->name = $data->input('name');
      $user->email = $data->input('email');
      $user->phone = $data->input('phone');
      $user->user_name = $data->input('user_name');
      $user->save();

      return redirect('/faculty')->with('success', 'Tutor Updated Successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tutor= User::find($id);
      //Check if user_id matches the contact's user_id for correct user to edit correct contact
      if(auth()->user()->role !== "Admin"){
        return redirect('/')->with('error','Unauuthorised access - Cannot delete contact that you did not create');
      }
      else{
        $tutor->delete();
        return redirect('/faculty')->with('success',  "You've successfully deleted " . $tutor->name . " .");


      }


    }
}
