<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5CompanyController extends Controller
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
        var_dump($datosForm);
        WikiAf5Company::create($datosForm);
        return Redirect::route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Company $wikiAf5Company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function edit(WikiAf5Company $wikiAf5Company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WikiAf5Company $wikiAf5Company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Company $wikiAf5Company)
    {
        //
    }
}
