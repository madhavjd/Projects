<?php

namespace App\Http\Controllers;

use App\Models\Identitycard;
use Illuminate\Http\Request;

class IdentitycardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indentity = Identitycard::with(['user'])->get();
        dd($indentity);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Identitycard $identitycard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Identitycard $identitycard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Identitycard $identitycard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Identitycard $identitycard)
    {
        //
    }
}
