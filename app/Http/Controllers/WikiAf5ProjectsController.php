<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Projects;
use App\Models\User;
use App\Models\WikiAf5Priorities;
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
        // $responsible =  DB::table('users')
        // ->join('wiki_af5_projects', 'responsible_id', '=', 'users.id')
        // ->select('users.*')->get();
        // DB::table('users')
        // ->join('contacts', function ($join) {
        //     $join->on('users.id', '=', 'contacts.user_id')->orOn(...);
        // })
        // ->get();

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
            ->with('users')
            ->paginate(20)
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
    {   $users = User::where('user_type_id', 1)->get();
        $priorities = WikiAf5Priorities::all();
        return Inertia::render('Projects/ProjectForm')->with('priorities', $priorities)->with('allUsers', $users);
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

        return Redirect::route('projects');
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
                $users = User::where('user_type_id', 1)->get();
                $priorities = WikiAf5Priorities::all();
                return Inertia::render('Projects/Show', ['project' =>  $project, 'priorities' => $priorities, 'allUsers' => $users]);
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
    public function edit(WikiAf5Projects $wikiAf5Projects)
    {
        $users = User::where('user_type_id', 1)->get();
        $priorities = WikiAf5Priorities::all();
        
        return Inertia::render('Projects/ProjectEditForm', [ 
            'WikiAf5Projects' => [
                'id' => $wikiAf5Projects->id,
                'name' => $wikiAf5Projects->name,
                'alias' => $wikiAf5Projects->alias,
                'responsible' => $wikiAf5Projects->responsible_id,
                'description' => $wikiAf5Projects->description,
                'priority' => $wikiAf5Projects->priority_id,
                'start_date' => $wikiAf5Projects->start_date,
                'end_date' => $wikiAf5Projects->end_date,
            ], 'priorities' => $priorities, 'allUsers' => $users
        ]);
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
        $wikiAf5Projects->update($request->all());
        return Redirect::route('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Projects  $wikiAf5Projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Projects $wikiAf5Projects)
    {
        $wikiAf5Projects->delete();
        return Redirect::back()->with('success', 'Proyecto borrado.');
    }
}
