<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use DB;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(employee $employee)
    {
        // $allemployee = $employee->all();
        $allemployee = DB::table('employees')
        ->selectRaw('*, branches.id as branchid,employees.id as empid ')
        ->join('branches', 'employees.branch_id', '=', 'branches.id')
        ->get();
        return $allemployee;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(employee $employee,Request $request)
    {
        // dd($request->all());
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->branch_id = $request->branch_title;
        $employee->salary = $request->salary;
       return $employee->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,employee $employee)
    {
        // dd($id);
        DB::connection()->enableQueryLog();

        // $allemployee = DB::table('employees')
        // ->join('branches', 'employees.branch_id', '=', 'branches.id')
        $allemployee = DB::table('employees')
        ->selectRaw('*, branches.id as branchid,employees.id as empid ')
        ->join('branches', 'employees.branch_id', '=', 'branches.id')
        ->where('employees.id', $id)
        ->get();
        $queries = DB::getQueryLog();

        // dd($queries);
         return $allemployee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request, employee $employee)
    {
        // dd($request->all());
        // $employee = DB::table('employees')
        // ->selectRaw('*, branches.id as branchid,employees.id as empid ')
        // ->join('branches', 'employees.branch_id', '=', 'branches.id')
        // ->where('employees.id', $id)
        // ->get();
        
        $employeedata = $employee::find($id);
         $employeedata->firstname = $request->firstname;
         $employeedata->lastname = $request->lastname;
         $employeedata->email = $request->email;
         $employeedata->mobile = $request->mobile;
         $employeedata->branch_id = $request->branch_title;
         $employeedata->salary = $request->salary;
         return $employeedata->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,employee $employee)
    {
        $employeedata = $employee::find($id);
        $employeedata->delete();
    }
}
