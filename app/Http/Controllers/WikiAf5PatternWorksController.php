<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5PatternWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class WikiAf5PatternWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        
         $patterns = WikiAf5PatternWork::query()
            ->orderBy('name', 'ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('name','LIKE','%' . $term . '%');})
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');


        return Inertia::render('PatternWorks/Index', [
       
            'patterns' =>  $patterns,
            'paginator' =>WikiAf5PatternWork::paginate(10)
          
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $users = User::where('user_type_id', 3)->get();
        $patterns = WikiAf5PatternWork::all();
        return Inertia::render('PatternWorks/PatternForm')->with('patterns', $patterns);
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
                'project_type' => 'required',
                'patterns' => 'required',
            ]
        );

        WikiAf5PatternWork::create($request->all());

        return Redirect::route('patternworks')->with('success', '¡Patrón de trabajo creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        if (isset($request['patternwork']) && $request['patternwork']) {

            $patternwork_id = $request['patternwork'];
            $patternwork = WikiAf5PatternWork::find($patternwork_id);

            if (isset($patternwork->id)){

                return Inertia::render('PatternWorks/Show', ['patternwork' =>  $patternwork]);
            }
        } 
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        if (isset($request['patternwork']) && $request['patternwork']) {

            $patternwork_id = $request['patternwork'];
            $patternwork = WikiAf5PatternWork::find($patternwork_id);

            if (isset($patternwork->id)){

                return Inertia::render('PatternWorks/PatternEditForm', ['patternwork' =>  $patternwork]);
            }
        } 
        abort(404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (isset($request['patternwork']) && $request['patternwork']) {

            $patternwork_id = $request['patternwork'];
            $patternwork = WikiAf5PatternWork::find($patternwork_id);

            if (isset($patternwork->id)){

                $patternwork->update($request->all());

                return Redirect::route('patternworks')->with('success', '¡Patrón de trabajo editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (isset($request['patternwork']) && $request['patternwork']) {

            $patternwork_id = $request['patternwork'];
            $patternwork = WikiAf5PatternWork::find($patternwork_id);

            if (isset($patternwork->id)){

                $patternwork->delete();

                return redirect()->back()->with('success', 'Patrón de trabajo borrado correctamente');
            }
        } 
        abort(404);     
    }
}
