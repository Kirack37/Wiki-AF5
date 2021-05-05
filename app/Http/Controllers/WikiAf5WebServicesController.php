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
            'webServices' =>  $web_services,
            'paginator' =>WikiAf5WebServices::paginate(10)
      
     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        // $user_id = Auth::id();
        $projects = WikiAf5Projects::where('id', $id)->get();

        return Inertia::render('ProjectsWebServices/WebServicesForm', ['projects' => $projects])->with('status', '¡Web service creado correctamente!');
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

        WikiAf5WebServices::create($request->all());

        return Redirect::route('webservices.index', $id)->with('success', '¡Web service creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5WebServices $wikiAf5WebServices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // $user_id = Auth::id();
        $project = WikiAf5Projects::where('id', $id)->get();
        
        if (isset($request['web_service']) && $request['web_service']) {
            $web_service_id = $request['web_service'];
            $web_service = WikiAf5WebServices::find($web_service_id);

            if (isset($web_service->id)){
                
                return Inertia::render('ProjectsHistory/HistoryEditForm', ['project' =>  $project, 'webService' => $web_service]);
            }
        } 
        abort(404);
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
        if (isset($request['web_service']) && $request['web_service']) {
            $web_service_id = $request['web_service'];
            $web_service = WikiAf5WebServices::find($web_service_id);
            if (isset($web_service->id)){
                $web_service->update($request->all());
                return Redirect::route('webservices.index', $id)->with('success', '¡Web service editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5WebServices  $wikiAf5WebServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (isset($request['web_service']) && $request['web_service']) {
            $web_service_id = $request['web_service'];
            $web_service = WikiAf5WebServices::find($web_service_id);
            if (isset($web_service->id)){
                $web_service->delete();
                return redirect()->back()->with('success', 'Web service borrado correctamente');
            }
        } 
        abort(404);        
    }
}
