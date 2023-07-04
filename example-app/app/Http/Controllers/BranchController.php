<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Auth;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct() 
    {
        
    }
    public function index(Branch $branch)
    {
        // dd(Auth::user());
        $this->middleware('auth');
          if(Auth::user()->role_id != '1'){
                return redirect('login');
            } 
            $allbranches = $branch->all();
            return view("admin.adminmanagebranch",compact('allbranches'));
            // return $allbranches; 
        }
        public function getbranch(Request $request,Branch $branch){
            $allbranches = $branch->all();
            return $allbranches; 

    }

    public function checkvalidation(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|max:255',
            'data' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'mobile' => 'required|unique:users|min:10|max:10|integer',
        ]);
        dd("validation");
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
    public function store(Branch $branch, Request $request)
    {
        $branch->branch_title = $request->branch_title;
        $branch->branch_description = $request->branch_description;
        $res = $branch->save();
        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Branch $branch)
    {
         $branchData = $branch::find($id);
         return $branchData;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request, Branch $branch)
    {
        $branchData = $branch::find($id);
        $branchData->branch_title = $request->branch_title;
        $branchData->branch_description = $request->branch_description;
        $branchData->updated_at = date("Y-m-d H:i:s");
        $branchData->created_at = date("Y-m-d H:i:s");
        $branchData->save();
        return $branchData;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch,Request $request,$id)
    {
       $deletebranchdata = $branch::find($id)->delete();
       return $deletebranchdata;
    }
}
