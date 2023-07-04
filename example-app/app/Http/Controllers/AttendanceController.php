<?php

namespace App\Http\Controllers;
use Redirect;

use App\Models\attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
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
     */
    public function create(attendance $attendance)
    {
        // $userdata = auth()->user()->id;
        // dd($userdata);
        $attendance->emp_id = auth()->user()->id;
        $attendance->name = auth()->user()->name;
        $attendance->status = '1';
        $attendance->save();
        return Redirect::back()->withErrors(['msg' => 'Attendance given']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}
