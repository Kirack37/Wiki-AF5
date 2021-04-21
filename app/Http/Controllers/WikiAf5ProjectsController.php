<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Projects;
use App\Models\User;
use App\Models\WikiAf5Priorities;
use App\Models\WikiAf5ProjectsHistory;
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
        
        $projects = WikiAf5Projects::query()
            ->orderBy('name','ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('name','LIKE','%' . $term . '%');})
            ->with('users')
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');

        return Inertia::render('Projects/Index', [
       
            'projects' =>  $projects,
            'paginator' =>WikiAf5Projects::paginate(10)
          
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $users = User::where('user_type_id', 1)->get();
        $priorities = WikiAf5Priorities::all();
        return Inertia::render('Projects/ProjectForm')->with('priorities', $priorities)->with('allUsers', $users)->with('status', '¡Proyecto creado correctamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

       
        $request->validate(
            [   
                'name' => 'required',
                'start_date' => 'required',
                'description' => 'required',
                'responsible_id' => 'required',
                'priority_id' => 'required'
            ]
        );

        WikiAf5Projects::create($request->all());

        return Redirect::route('projects')->with('success', '¡Proyecto creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        if (isset($request['project']) && $request['project']) {
            $project_id = $request['project'];
            $project = WikiAf5Projects::find($project_id);
            if (isset($project->id)){
                $project->description = strip_tags($project->description);
                $history = WikiAf5ProjectsHistory::where('project_id', $project_id)->get();
                $responsible_id = $project->responsible_id;
                $responsible = User::where('id', $responsible_id)->get();
                $priority_id = $project->priority_id;
                $priority = WikiAf5Priorities::where('id', $priority_id)->get();
                return Inertia::render('Projects/Show', ['project' =>  $project, 'priority' => $priority, 'responsible' => $responsible, 'history' => $history]);
            }
        } 
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (isset($request['project']) && $request['project']) {
            $project_id = $request['project'];
            $project = WikiAf5Projects::find($project_id);
            if (isset($project->id)){
                $project->description = strip_tags($project->description);
                $responsibles = User::where('user_type_id', 1)->get();
                $priorities = WikiAf5Priorities::all();
                return Inertia::render('Projects/ProjectEditForm', ['project' =>  $project, 'priorities' => $priorities, 'responsibles' => $responsibles]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (isset($request['project']) && $request['project']) {
            $project_id = $request['project'];
            $project = WikiAf5Projects::find($project_id);
            if (isset($project->id)){
                $project->update($request->all());
                return Redirect::route('projects')->with('success', '¡Proyecto editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (isset($request['project']) && $request['project']) {
            $project_id = $request['project'];
            $project = WikiAf5Projects::find($project_id);
            if (isset($project->id)){
                $project->delete();
                return redirect()->back()->with('success', 'Proyecto borrado correctamente');
            }
        } 
        abort(404);        
    }
}
