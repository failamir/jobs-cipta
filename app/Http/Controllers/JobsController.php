<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; 

class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobs = Job::all();

        // return view('admin.jobs.index', compact('jobs'));
        return view('jobs',compact('jobs'));
    }
}
