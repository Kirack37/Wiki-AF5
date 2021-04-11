<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Priorities;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WikiAf5PrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Priorities/Form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosForm = Request()->all();
        return response()->json($datosForm);
        // $request->validate(
        //     [   
        //         'name' => 'required',
        //         'start_date' => 'required',
        //         'end_date',
        //         'alias',
        //         'description' => 'required',
        //         'responsible_id',
        //         'priority_id'
        //     ]
        // );

        WikiAf5Priorities::insert($datosForm);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Priorities  $wikiAf5Priorities
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Priorities $wikiAf5Priorities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Priorities  $wikiAf5Priorities
     * @return \Illuminate\Http\Response
     */
    public function edit(WikiAf5Priorities $wikiAf5Priorities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Priorities  $wikiAf5Priorities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WikiAf5Priorities $wikiAf5Priorities)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Priorities  $wikiAf5Priorities
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Priorities $wikiAf5Priorities)
    {
        //
    }
}
