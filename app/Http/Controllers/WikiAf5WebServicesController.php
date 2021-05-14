<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5WebServices;
use App\Models\WikiAf5Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5WebServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_servicios_web';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            $web_services = WikiAf5WebServices::where('project_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('name','LIKE','%' . $term . '%');})
                    ->with('projects')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('ProjectsWebServices/Index', [
                'project' => $project,
                'webservices' =>  $web_services,
                'paginator' =>WikiAf5WebServices::paginate(10)
        
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
        $slug_action = 'carga_form_creacion_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            // $user_id = Auth::id();
            $projects = WikiAf5Projects::where('id', $id)->get();

            return Inertia::render('ProjectsWebServices/WebServiceForm', ['projects' => $projects])->with('status', '¡Web service creado correctamente!');

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
        $slug_action = 'guardar_form_creacion_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'name' => 'required',
                ]
            );

            WikiAf5WebServices::create($request->all());

            return Redirect::route('webservices.index', $id)->with('success', '¡Web service creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $slug_action = 'carga_vista_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            // $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['webservice']) && $request['webservice']) {

                $web_service_id = $request['webservice'];
                $web_service = WikiAf5WebServices::find($web_service_id);

                if (isset($web_service->id)){
                    
                    return Inertia::render('ProjectsWebServices/Show', ['project' =>  $project, 'webservice' => $web_service]);
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
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            // $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['webservice']) && $request['webservice']) {

                $web_service_id = $request['webservice'];
                $web_service = WikiAf5WebServices::find($web_service_id);

                if (isset($web_service->id)){
                    
                    return Inertia::render('ProjectsWebServices/WebServiceEditForm', ['project' =>  $project, 'webservices' => $web_service]);
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
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['webservice']) && $request['webservice']) {

                $web_service_id = $request['webservice'];
                $web_service = WikiAf5WebServices::find($web_service_id);

                if (isset($web_service->id)){

                    $web_service->update($request->all());

                    return Redirect::route('webservices.index', $id)->with('success', '¡Web service editado correctamente!');
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
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_servicio_web';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['webservice']) && $request['webservice']) {

                $web_service_id = $request['webservice'];
                $web_service = WikiAf5WebServices::find($web_service_id);

                if (isset($web_service->id)){

                    $web_service->delete();

                    return redirect()->back()->with('success', 'Web service borrado correctamente');
                }
            } 
            abort(404);   
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
