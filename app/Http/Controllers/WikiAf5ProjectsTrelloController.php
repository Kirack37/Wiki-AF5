<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectsTrello;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\WikiAf5ProjectsEnviroments;
use App\Models\WikiAf5Projects;
use Inertia\Inertia;

class WikiAf5ProjectsTrelloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($project_id, $enviroment_id, Request $request)
    {
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $enviroment_id)->get();
        $project = WikiAf5Projects::where('id', $project_id)->get();
        $trellos = WikiAf5ProjectsTrello::where('project_enviroment_id' , $enviroment_id)
                ->orderBy('created_at', 'asc')
                ->when($request->term, function ($query, $term ){
                    $query->where('username','LIKE','%' . $term . '%');})
                ->with('enviroments')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

        return Inertia::render('ProjectsTrellos/Index', [
            'project' => $project,
            'enviroment' => $enviroment,
            'trellos' => $trellos,
            'paginator' =>WikiAf5ProjectsTrello::paginate(10)
        
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id, $enviroment_id)
    {   
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $enviroment_id)->get();
        $project = WikiAf5Projects::where('id', $project_id)->get();

        return Inertia::render('ProjectsTrellos/TrelloForm', ['enviroment' => $enviroment, 'project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($project_id, $enviroment_id, Request $request)
    {
        $request->validate(
            [   
                'url' => 'required',
                'username' => 'required',
            ]
        );

        WikiAf5ProjectsTrello::create($request->all());

        return Redirect::route('trello.index', [$project_id, $enviroment_id])->with('success', '¡Trello creado correctamente!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsTrello  $wikiAf5ProjectsTrello
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5ProjectsTrello $wikiAf5ProjectsTrello)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsTrello  $wikiAf5ProjectsTrello
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $enviroment_id, Request $request)
    {
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $enviroment_id)->get();
        $project = WikiAf5Projects::where('id', $project_id)->get();
        
        if (isset($request['trello']) && $request['trello']) {
            
            $trello_id = $request['trello'];
            $trello = WikiAf5ProjectsTrello::find($trello_id);

            if (isset($trello->id)){

                return Inertia::render('ProjectsTrellos/TrelloEditForm', ['enviroment' => $enviroment, 'trello' => $trello, 'project' => $project]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5ProjectsTrello  $wikiAf5ProjectsTrello
     * @return \Illuminate\Http\Response
     */
    public function update($project_id, $enviroment_id, Request $request)
    {
        if (isset($request['trello']) && $request['trello']) {
            $trello_id = $request['trello'];
            $trello = WikiAf5ProjectsTrello::find($trello_id);
            if (isset($trello->id)){
                $trello->update($request->all());
                return Redirect::route('trello.index', [$project_id, $enviroment_id])->with('success', '¡Trelo editado correctamente!');
            }
        } 
        abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5ProjectsTrello  $wikiAf5ProjectsTrello
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $enviroment_id, Request $request)
    {
        if (isset($request['trello']) && $request['trello']) {
            $trello_id = $request['trello'];
            $trello = WikiAf5ProjectsTrello::find($trello_id);
            if (isset($trello->id)){
                $trello->delete();
                return redirect()->back()->with('success', 'Trello borrado correctamente');
            }
        } 
        abort(404);        
    }
}
