<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5PatternWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class WikiAf5PatternWorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $slug_action = 'listado_patrones_trabajos';

        if(Auth::user()->can_action($slug_action)){
        
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

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slug_action = 'carga_form_creacion_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){
            // $users = User::where('user_type_id', 3)->get();
            $patterns = WikiAf5PatternWork::all();
            return Inertia::render('PatternWorks/PatternForm')->with('patterns', $patterns);

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
    public function store(Request $request)
    {
        $slug_action = 'guardar_form_creacion_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'name' => 'required',
                    'project_type' => 'required',
                    'patterns' => 'required',
                ]
            );

            WikiAf5PatternWork::create($request->all());

            return Redirect::route('patternworks')->with('success', '¡Patrón de trabajo creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $slug_action = 'carga_vista_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['patternwork']) && $request['patternwork']) {

                $patternwork_id = $request['patternwork'];
                $patternwork = WikiAf5PatternWork::find($patternwork_id);

                if (isset($patternwork->id)){

                    return Inertia::render('PatternWorks/Show', ['patternwork' =>  $patternwork]);
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
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){
        
            if (isset($request['patternwork']) && $request['patternwork']) {

                $patternwork_id = $request['patternwork'];
                $patternwork = WikiAf5PatternWork::find($patternwork_id);

                if (isset($patternwork->id)){

                    return Inertia::render('PatternWorks/PatternEditForm', ['patternwork' =>  $patternwork]);
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
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slug_action = 'guardar_form_edicion_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['patternwork']) && $request['patternwork']) {

                $patternwork_id = $request['patternwork'];
                $patternwork = WikiAf5PatternWork::find($patternwork_id);

                if (isset($patternwork->id)){

                    $patternwork->update($request->all());

                    return Redirect::route('patternworks')->with('success', '¡Patrón de trabajo editado correctamente!');
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
     * @param  \App\Models\WikiAf5PatternWork  $wikiAf5PatternWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_patron_trabajo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['patternwork']) && $request['patternwork']) {

                $patternwork_id = $request['patternwork'];
                $patternwork = WikiAf5PatternWork::find($patternwork_id);

                if (isset($patternwork->id)){

                    $patternwork->delete();

                    return redirect()->back()->with('success', 'Patrón de trabajo borrado correctamente');
                }
            } 
            abort(404);  
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
