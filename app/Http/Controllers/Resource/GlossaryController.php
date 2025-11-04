<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Glossary;
use App\Http\Requests\StoreGlossaryRequest;
use App\Http\Requests\UpdateGlossaryRequest;

use Illuminate\Support\Facades\Auth;

class GlossaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.glossaries');
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
    public function store(StoreGlossaryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Glossary $glossary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Glossary $glossary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGlossaryRequest $request, Glossary $glossary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Glossary $glossary)
    {
        //
    }
}
