<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectsEnviroments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\WikiAf5Projects;
use Inertia\Inertia;

class WikiAf5ProjectsEnviromentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_entornos_proyectos';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            $enviroments = WikiAf5ProjectsEnviroments::where('project_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('subject','LIKE','%' . $term . '%');})
                    ->with('projects')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('ProjectsEnviroments/Index', [
                'project' => $project,
                'enviroments' => $enviroments,
                'paginator' =>WikiAf5ProjectsEnviroments::paginate(10)
            
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
        $slug_action = 'carga_form_creacion_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $projects = WikiAf5Projects::where('id', $id)->get();

            return Inertia::render('ProjectsEnviroments/EnviromentForm', ['projects' => $projects]);

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
        $slug_action = 'guardar_form_creacion_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'name' => 'required',
                ]
            );

            WikiAf5ProjectsEnviroments::create($request->all());

            return Redirect::route('enviroments.index', $id)->with('success', '¡Entorno creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {   
        $slug_action = 'vista_detalles_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['enviroment']) && $request['enviroment']) {


                $enviroment_id = $request['enviroment'];
                $project = WikiAf5Projects::where('id', $id)->get();
                $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);
                
                if (isset($enviroment->id)){
        
                    return Inertia::render('ProjectsEnviroments/Show', ['enviroment' =>  $enviroment, 'project' => $project]);
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
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['enviroment']) && $request['enviroment']) {
                
                $enviroment_id = $request['enviroment'];
                $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);

                if (isset($enviroment->id)){

                    return Inertia::render('ProjectsEnviroments/EnviromentEditForm', ['project' =>  $project, 'enviroment' => $enviroment]);
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
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['enviroment']) && $request['enviroment']) {

                $enviroment_id = $request['enviroment'];
                $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);

                if (isset($enviroment->id)){

                    $enviroment->update($request->all());

                    return Redirect::route('enviroments.index', $id)->with('success', '¡Entorno editado correctamente!');
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
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_entorno_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['enviroment']) && $request['enviroment']) {

                $enviroment_id = $request['enviroment'];
                $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);

                if (isset($enviroment->id)){

                    $enviroment->delete();
                    
                    return redirect()->back()->with('success', '¡Entorno borrado correctamente');
                }
            } 
            abort(404);  
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
