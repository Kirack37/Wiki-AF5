<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5MeetingsUsers;
use App\Models\WikiAf5Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5MeetingsUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_usuarios_reuniones';

        $meetings = WikiAf5Meetings::where('id', $id)->get();
        $users = WikiAf5MeetingsUsers::where('meeting_id' , $id)
                ->orderBy('created_at', 'asc')
                ->when($request->term, function ($query, $term ){
                    $query->where('status','LIKE','%' . $term . '%');})
                ->with('users')
                ->with('meetings')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

        return Inertia::render('MeetingsUsers/Index', [
            'meetings' => $meetings,
            'users' =>  $users,
            'paginator' =>WikiAf5MeetingsUsers::paginate(10)
      
     ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $slug_action = 'carga_form_creacion_usuario_reunion';

        $user_id = Auth::id();
        $meetings = WikiAf5Meetings::where('id', $id)->get();

        return Inertia::render('MeetingsNotes/NoteForm', ['meetings' => $meetings, 'user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $slug_action = 'guardar_form_creacion_usuario_reunion';

        $request->validate(
            [   
                'subjects' => 'required',
                'notes' => 'required',
            ]
        );

        WikiAf5MeetingsUsers::create($request->all());

        return Redirect::route('users.index', $id)->with('success', 'Usuario de la reunión creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsUsers  $wikiAf5MeetingsUsers
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5MeetingsUsers $wikiAf5MeetingsUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsUsers  $wikiAf5MeetingsUsers
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_usuario_reunion';

        $user_id = Auth::id();

        $meeting = WikiAf5Meetings::where('id', $id)->get();
        
        if (isset($request['user']) && $request['user']) {

            $user_id = $request['user'];
            $user = WikiAf5MeetingsUsers::find($user_id);

            if (isset($user->id)){
                
                return Inertia::render('MeetingsUsers/UserEditForm', ['meeting' =>  $meeting, 'user' => $user, 'user_id' => $user_id]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5MeetingsUsers  $wikiAf5MeetingsUsers
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_usuario_reunion';
        
        if (isset($request['user']) && $request['user']) {

            $user_id = $request['user'];
            $user = WikiAf5MeetingsUsers::find($user_id);

            if (isset($user->id)){

                $user->update($request->all());

                return Redirect::route('meetingusers.index', $id)->with('success', '¡Usuario de reunión editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5MeetingsUsers  $wikiAf5MeetingsUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_usuario_reunion';

        if (isset($request['user']) && $request['user']) {

            $user_id = $request['user'];
            $user = WikiAf5MeetingsUsers::find($user_id);

            if (isset($user->id)){

                $user->delete();

                return redirect()->back()->with('success', 'Usuario de reunión borrado correctamente');
            }
        } 
        abort(404);        
    }
}
