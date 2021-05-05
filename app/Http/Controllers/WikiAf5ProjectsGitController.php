<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectsGit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\WikiAf5ProjectsEnviroments;
use App\Models\WikiAf5Projects;
use Inertia\Inertia;

class WikiAf5ProjectsGitController extends Controller
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
        $gits = WikiAf5ProjectsGit::where('project_enviroment_id' , $enviroment_id)
                ->orderBy('created_at', 'asc')
                ->when($request->term, function ($query, $term ){
                    $query->where('repository_name','LIKE','%' . $term . '%');})
                ->with('enviroments')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

        return Inertia::render('ProjectsGITs/Index', [
            'project' => $project,
            'enviroment' => $enviroment,
            'gits' => $gits,
            'paginator' =>WikiAf5ProjectsGit::paginate(10)
        
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

        return Inertia::render('ProjectsGITs/GitForm', ['enviroment' => $enviroment, 'project' => $project]);
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
                'repository_url' => 'required',
                'repository_name' => 'required',
            ]
        );

        WikiAf5ProjectsGit::create($request->all());

        return Redirect::route('git.index', [$project_id, $enviroment_id])->with('success', '¡GIT creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsGit  $wikiAf5ProjectsGit
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5ProjectsGit $wikiAf5ProjectsGit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectsGit  $wikiAf5ProjectsGit
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $enviroment_id, Request $request)
    {
        $enviroment = WikiAf5ProjectsEnviroments::where('id', $enviroment_id)->get();
        $project = WikiAf5Projects::where('id', $project_id)->get();
        
        if (isset($request['git']) && $request['git']) {
            
            $git_id = $request['git'];
            $git = WikiAf5ProjectsGit::find($git_id);

            if (isset($git->id)){

                return Inertia::render('ProjectsGITs/GitEditForm', ['enviroment' => $enviroment, 'git' => $git, 'project' => $project]);
            }
        } 
        abort(404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5ProjectsGit  $wikiAf5ProjectsGit
     * @return \Illuminate\Http\Response
     */
    public function update($project_id, $enviroment_id, Request $request)
    {
        if (isset($request['git']) && $request['git']) {
            $git_id = $request['git'];
            $git = WikiAf5ProjectsGit::find($git_id);
            if (isset($git->id)){
                $git->update($request->all());
                return Redirect::route('git.index', [$project_id, $enviroment_id])->with('success', '¡Git editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5ProjectsGit  $wikiAf5ProjectsGit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (isset($request['git']) && $request['git']) {
            $git_id = $request['git'];
            $git = WikiAf5ProjectsGit::find($git_id);
            if (isset($git->id)){
                $git->delete();
                return redirect()->back()->with('success', 'Git borrado correctamente');
            }
        } 
        abort(404);        
    }
}
