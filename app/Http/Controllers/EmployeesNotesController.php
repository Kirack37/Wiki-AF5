<?php

namespace App\Http\Controllers;

use App\Models\EmployeesNotes;
use App\Models\User;
use App\Models\WikiAf5EmployeesNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmployeesNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $users = User::all();

        $slug_action = 'listado_notas_personales';

        $user_id = Auth::id();
        $notes = EmployeesNotes::query()
            ->orderBy('title', 'ASC')
            ->where('user_id', $user_id)
            ->when($request->term, function ($query, $term ){
                $query->where('title','LIKE','%' . $term . '%');})
            ->with('user')
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');


        return Inertia::render('EmployeesNotes/Index', [
       
            'user_id' => $user_id,
            'notes' =>  $notes,
            'paginator' =>EmployeesNotes::paginate(10)
          
         ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $slug_action = 'carga_form_creacion_nota_personal';

        $user_id = Auth::id();
        $notes = WikiAf5EmployeesNotes::where('id', $user_id)->get();

        return Inertia::render('EmployeesNotes/NoteForm', ['notes' => $notes, 'user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug_action = 'guardar_form_creacion_nota_personal';

        $request->validate(
            [   
                'user_id' => 'required',
                'type' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]
        );
        WikiAf5EmployeesNotes::create($request->all());

        return Redirect::route('personalnotes')->with('success', '¡Nota personal creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesNotes  $employeesNotes
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesNotes $employeesNotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesNotes  $employeesNotes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_nota_personal';

        $user_id = Auth::id();
        
        if (isset($request['personalnote']) && $request['personalnote']) {
            $note_id = $request['personalnote'];
            $note = EmployeesNotes::find($note_id);

            if (isset($note->id)){
                
                return Inertia::render('EmployeesNotes/NoteEditForm', ['note' =>  $note, 'user_id' => $user_id]);
            }
        } 
        abort(404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesNotes  $employeesNotes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slug_action = 'guardar_form_edicion_nota_personal';

        if (isset($request['personalnote']) && $request['personalnote']) {

            $note_id = $request['personalnote'];
            $note = EmployeesNotes::find($note_id);

            if (isset($note->id)){

                $note->update($request->all());

                return Redirect::route('personalnotes')->with('success', '¡Nota personal editada correctamente!');
            }
        } 
        abort(404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesNotes  $employeesNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_nota_personal';

        if (isset($request['personalnote']) && $request['personalnote']) {

            $note_id = $request['personalnote'];
            $note = EmployeesNotes::find($note_id);

            if (isset($note->id)){

                $note->delete();

                return redirect()->back()->with('success', 'Nota personal borrada correctamente');
            }
        } 
        abort(404);        
    }
}
