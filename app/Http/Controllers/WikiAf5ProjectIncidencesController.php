<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectIncidences;
use App\Models\WikiAf5Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5ProjectIncidencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_incidencias_proyectos';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            $incidences = WikiAf5ProjectIncidences::where('project_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('subject','LIKE','%' . $term . '%');})
                    ->with('users')
                    ->with('projects')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('ProjectsIncidences/Index', [
                'project' => $project,
                'incidences' =>  $incidences,
                'paginator' =>WikiAf5ProjectIncidences::paginate(10)
            
            ]);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $slug_action = 'carga_form_creacion_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $projects = WikiAf5Projects::where('id', $id)->get();

            return Inertia::render('ProjectsIncidences/IncidenceForm', ['projects' => $projects, 'user_id' => $user_id]);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $slug_action = 'guardar_form_creacion_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'description' => 'required',
                    'reason' => 'required',
                ]
            );

            WikiAf5ProjectIncidences::create($request->all());

            return Redirect::route('incidences.index', $id)->with('success', '¡Incidencia creada correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectIncidences  $wikiAf5ProjectIncidences
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $slug_action = 'carga_vista_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['incidence']) && $request['incidence']) {
                $incidence_id = $request['incidence'];
                $incidence = WikiAf5ProjectIncidences::find($incidence_id);

                if (isset($incidence->id)){
                    return Inertia::render('ProjectsIncidences/Show', ['project' =>  $project, 'incidence' => $incidence, 'user_id' => $user_id]);
                }
            } 
            abort(404);


        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectIncidences  $wikiAf5ProjectIncidences
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['incidence']) && $request['incidence']) {
                $incidence_id = $request['incidence'];
                $incidence = WikiAf5ProjectIncidences::find($incidence_id);

                if (isset($incidence->id)){
                    $incidence->description = strip_tags($incidence->description);
                    return Inertia::render('ProjectsIncidences/IncidenceEditForm', ['project' =>  $project, 'incidence' => $incidence, 'user_id' => $user_id]);
                }
            } 
            abort(404);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5ProjectIncidences  $wikiAf5ProjectIncidences
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['incidence']) && $request['incidence']) {
                $incidence_id = $request['incidence'];
                $incidence = WikiAf5ProjectIncidences::find($incidence_id);
                if (isset($incidence->id)){
                    $incidence->update($request->all());
                    return Redirect::route('incidences.index', $id)->with('success', '¡Incidencia editada correctamente!');
                }
            } 
            abort(404);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5ProjectIncidences  $wikiAf5ProjectIncidences
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_incidencia_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['incidence']) && $request['incidence']) {
                $incidence_id = $request['project'];
                $incidence = WikiAf5ProjectIncidences::find($incidence_id);
                if (isset($incidence->id)){
                    $incidence->delete();
                    return redirect()->back()->with('success', 'Incidencia borrada correctamente');
                }
            } 
            abort(404);  
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
