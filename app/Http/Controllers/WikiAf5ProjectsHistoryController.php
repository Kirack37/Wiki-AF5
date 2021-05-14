<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectsHistory;
use App\Models\WikiAf5Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5ProjectsHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_historiales_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            $histories = WikiAf5ProjectsHistory::where('project_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('description','LIKE','%' . $term . '%');})
                    ->with('users')
                    ->with('projects')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('ProjectsHistory/Index', [
                'project' => $project,
                'histories' =>  $histories,
                'paginator' =>WikiAf5ProjectsHistory::paginate(10)
        
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
        $slug_action = 'carga_form_creacion_historial_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $projects = WikiAf5Projects::where('id', $id)->get();

            return Inertia::render('ProjectsHistory/HistoryForm', ['projects' => $projects, 'user_id' => $user_id])->with('status', '¡Historial creado correctamente!');

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
        $slug_action = 'guardar_form_creacion_historial_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'description' => 'required',
                ]
            );

            WikiAf5ProjectsHistory::create($request->all());

            return Redirect::route('history.index', $id)->with('success', '¡Historial creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsHistory  $wikiAf5ProjectsHistory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        // if (isset($request['history']) && $request['history']) {
        //     $history_id = $request['project'];
        //     $history = WikiAf5ProjectsHistory::find($history_id);
        //     if (isset($history->id)){
        //         $history->description = strip_tags($history->description);
        //         $user_id = $history->user_id;
        //         $user = User::where('id', $user_id)->get();
        //         return Inertia::render('ProjectsHistory/Show', ['history' =>  $history, 'user' => $user]);
        //     }
        // } 
        // abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsHistory  $wikiAf5ProjectsHistory
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_historial_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['history']) && $request['history']) {

                $history_id = $request['history'];
                $history = WikiAf5ProjectsHistory::find($history_id);

                if (isset($history->id)){

                    $history->description = strip_tags($history->description);

                    return Inertia::render('ProjectsHistory/HistoryEditForm', ['project' =>  $project, 'history' => $history, 'user_id' => $user_id]);
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
     * @param  \App\Models\WikiAf5ProjectsHistory  $wikiAf5ProjectsHistory
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_historial_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['history']) && $request['history']) {

                $history_id = $request['history'];
                $history = WikiAf5ProjectsHistory::find($history_id);

                if (isset($history->id)){

                    $history->update($request->all());

                    return Redirect::route('history.index', $id)->with('success', '¡Historial editado correctamente!');
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
     * @param  \App\Models\WikiAf5ProjectsHistory  $wikiAf5ProjectsHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_historial_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['history']) && $request['history']) {

                $history_id = $request['history'];
                $history = WikiAf5ProjectsHistory::find($history_id);

                if (isset($history->id)){

                    $history->delete();

                    return redirect()->back()->with('success', 'Historial borrado correctamente');
                }
            } 
            abort(404);    
            
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
