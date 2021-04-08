<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // when($request->term, function($query, $term){
        // })->paginate();
        // ::where('user_id', Auth::user()->id)->orderby('fecha_revision','DESC')->first()
        
        return Inertia::render('Projects/Index', [
            // 'filters' => Request::all('search'),
            // // 'wikiaf5projects' =>  $wiki_af5_projects
            // // 'wikiaf5projects' => WikiAf5Projects::where('name','LIKE','%{request->term}%')
            // //     ->paginate(15)                
            // //     ->withQueryString()
            // //     ->sortBy("name")
            'wikiaf5projects' => WikiAf5Projects::orderBy('name','ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('name','LIKE','%' . $term . '%');})
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name')
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Projects $wikiAf5Projects)
    {   
        $wikiAf5Projects = WikiAf5Projects::all();

        return Inertia::render('Projects/Show', ['wiki_af5_projects' => $wikiAf5Projects]);
        // return Inertia::render('Projects/Show', [
        //     'wikiAf5Projects' => $wikiAf5Projects->only('id','start_date','end_date','description','name','alias','responsible')
        //  ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function edit(WikiAf5Projects $wikiAf5Projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WikiAf5Projects $wikiAf5Projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Projects $wikiAf5Projects)
    {
        //
    }
}
