<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BatchClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('faculty');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $batches = BatchClass::where('tutor_id',auth()->user()->id)->get()->sortByDesc('created_at');
        return view('home')->with('batches',$batches);
    }
}
