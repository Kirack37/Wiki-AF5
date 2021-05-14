<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WikiAf5MeetingsUsers;
use App\Models\WikiAf5Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Support\Utils\OctaModal;


class WikiAf5MeetingsUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WikiAf5Meetings $WikiAf5Meetings, array $modalProps = [])
    {
        $slug_action = 'listado_usuarios_reuniones';
        

        // return inertia('MeetingsUsers/Index', array_merge([
        //     'meeting' => $WikiAf5Meetings,
        //     'users' => $WikiAf5Meetings
        //         ->meeting_users()
        //         ->orderBy('created_at', 'desc')
        //         ->paginate(),
        // ], $modalProps));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(WikiAf5Meetings $WikiAf5Meetings)
    {   
        $slug_action = 'carga_form_creacion_usuario_reunion';

        // inertia()->modal('MeetingUsers/CreateModal');

        // return $this->index($WikiAf5Meetings, [
        //     'users' => User::all(),
        // ]);
        // return OctaModal::create()
        //     ->title("Create Post")
        //     ->route('meetingusers.store')
        //     ->get();
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
