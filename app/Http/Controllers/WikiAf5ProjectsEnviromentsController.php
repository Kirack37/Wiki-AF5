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
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $projects = WikiAf5Projects::where('id', $id)->get();

        return Inertia::render('ProjectsEnviroments/EnviromentForm', ['projects' => $projects]);
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

        WikiAf5ProjectsEnviroments::create($request->all());

        return Redirect::route('enviroments.index', $id)->with('success', '¡Entorno creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
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
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $project = WikiAf5Projects::where('id', $id)->get();
        
        if (isset($request['enviroment']) && $request['enviroment']) {
            
            $enviroment_id = $request['enviroment'];
            $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);

            if (isset($enviroment->id)){

                return Inertia::render('ProjectsEnviroments/EnviromentEditForm', ['project' =>  $project, 'enviroment' => $enviroment]);
            }
        } 
        abort(404);
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
        // dd($request);
        if (isset($request['enviroment']) && $request['enviroment']) {
            $enviroment_id = $request['enviroment'];
            $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);
            if (isset($enviroment->id)){
                $enviroment->update($request->all());
                return Redirect::route('enviroments.index', $id)->with('success', '¡Entorno editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5ProjectsEnviroments  $wikiAf5ProjectsEnviroments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (isset($request['enviroment']) && $request['enviroment']) {
            $enviroment_id = $request['enviroment'];
            $enviroment = WikiAf5ProjectsEnviroments::find($enviroment_id);
            if (isset($enviroment->id)){
                $enviroment->delete();
                return redirect()->back()->with('success', '¡Entorno borrado correctamente');
            }
        } 
        abort(404);        
    }
}
