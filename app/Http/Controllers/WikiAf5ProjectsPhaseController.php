<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectsPhase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\WikiAf5ProjectsEnviroments;
use App\Models\WikiAf5Projects;
use Inertia\Inertia;

class WikiAf5ProjectsPhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $id)->get();
        $phases = WikiAf5ProjectsPhase::where('project_enviroment_id' , $id)
                ->orderBy('created_at', 'asc')
                ->when($request->term, function ($query, $term ){
                    $query->where('repository_name','LIKE','%' . $term . '%');})
                ->with('projects')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

        return Inertia::render('ProjectsGITs/Index', [
            'enviroment' => $enviroment,
            'phases' => $phases,
            'paginator' =>WikiAf5ProjectsPhase::paginate(10)
        
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $id)->get();

        return Inertia::render('ProjectsPhases/PhaseForm', ['enviroment' => $enviroment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $request->validate(
            [   
                'name' => 'required',
            ]
        );

        WikiAf5ProjectsPhase::create($request->all());

        return Redirect::route('phases.index', $id)->with('success', '¡Fase creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsPhase  $wikiAf5ProjectsPhase
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5ProjectsPhase $wikiAf5ProjectsPhase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsPhase  $wikiAf5ProjectsPhase
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $id)->get();
        
        if (isset($request['phase']) && $request['phase']) {
            
            $phase_id = $request['phase'];
            $phase = WikiAf5ProjectsPhase::find($phase_id);

            if (isset($phase->id)){

                return Inertia::render('ProjectsPhases/PhaseEditForm', ['enviroment' => $enviroment, 'phase' => $phase]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5ProjectsPhase  $wikiAf5ProjectsPhase
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if (isset($request['phase']) && $request['phase']) {
            $phase_id = $request['phase'];
            $phase = WikiAf5ProjectsPhase::find($phase_id);
            if (isset($phase->id)){
                $phase->update($request->all());
                return Redirect::route('phases.index', $id)->with('success', '¡Fase editada correctamente!');
            }
        } 
        abort(404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5ProjectsPhase  $wikiAf5ProjectsPhase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (isset($request['phase']) && $request['phase']) {
            $phase_id = $request['phase'];
            $phase = WikiAf5ProjectsPhase::find($phase_id);
            if (isset($phase->id)){
                $phase->delete();
                return redirect()->back()->with('success', 'Fase borrada correctamente');
            }
        } 
        abort(404);        
    }
}
