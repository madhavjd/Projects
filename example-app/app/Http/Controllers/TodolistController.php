<?php

namespace App\Http\Controllers;

use App\Models\todolist;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(todolist $todolist)
    {
        return $todolist->all();
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
    public function store(todolist $todolist,Request $request)
    {
        $todolist->username = $request->title;
        $todolist->email = $request->email;
        return $todolist->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(todolist $todolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request,todolist $todolist)
    {
       return $todolist::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request, todolist $todolist)
    {
    //    dd($request->all());
       $updateTodolist = todolist::find($id);
       $updateTodolist->username = $request->title;
       $updateTodolist->email = $request->email;
       return $updateTodolist->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id,Request $request,todolist $todolist)
    {
        $UserData=$todolist::find($id);
        return $UserData->delete();
    }
}
