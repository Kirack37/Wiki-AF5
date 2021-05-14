<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ProjectNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\WikiAf5Projects;
use Inertia\Inertia;

class WikiAf5ProjectNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_notas_proyectos';

        if(Auth::user()->can_action($slug_action)){

            $project = WikiAf5Projects::where('id', $id)->get();
            $notes = WikiAf5ProjectNotes::where('project_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('subject','LIKE','%' . $term . '%');})
                    ->with('users')
                    ->with('projects')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('ProjectsNotes/Index', [
                'project' => $project,
                'notes' =>  $notes,
                'paginator' =>WikiAf5ProjectNotes::paginate(10)
            
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
        $slug_action = 'carga_form_creacion_nota_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $projects = WikiAf5Projects::where('id', $id)->get();

            return Inertia::render('ProjectsNotes/NoteForm', ['projects' => $projects, 'user_id' => $user_id]);

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
        $slug_action = 'guardar_form_creacion_nota_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'subject' => 'required',
                    'note' => 'required',
                ]
            );

            WikiAf5ProjectNotes::create($request->all());

            return Redirect::route('notes.index', $id)->with('success', '¡Nota creada correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ProjectNotes  $wikiAf5ProjectNotes
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
     * @param  \App\Models\WikiAf5ProjectNotes  $wikiAf5ProjectNotes
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_nota_proyecto';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $project = WikiAf5Projects::where('id', $id)->get();
            
            if (isset($request['note']) && $request['note']) {
                
                $note_id = $request['note'];
                $note = WikiAf5ProjectNotes::find($note_id);

                if (isset($note->id)){

                    $note->note = strip_tags($note->note);

                    return Inertia::render('ProjectsNotes/NoteEditForm', ['project' =>  $project, 'note' => $note, 'user_id' => $user_id]);
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
     * @param  \App\Models\WikiAf5ProjectNotes  $wikiAf5ProjectNotes
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_nota_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['note']) && $request['note']) {

                $note_id = $request['note'];
                $note = WikiAf5ProjectNotes::find($note_id);

                if (isset($note->id)){

                    $note->update($request->all());

                    return Redirect::route('notes.index', $id)->with('success', '¡Nota editada correctamente!');
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
     * @param  \App\Models\WikiAf5ProjectNotes  $wikiAf5ProjectNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_nota_proyecto';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['project']) && $request['note']) {

                $note_id = $request['project'];
                $note = WikiAf5ProjectNotes::find($note_id);

                if (isset($note->id)){

                    $note->delete();

                    return redirect()->back()->with('success', 'Nota borrada correctamente');
                }
            } 
            abort(404);   
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
