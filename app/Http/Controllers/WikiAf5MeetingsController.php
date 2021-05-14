<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Meetings;
use App\Models\User;
use App\Models\WikiAf5Priorities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;



class WikiAf5MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_reuniones';

        if(Auth::user()->can_action($slug_action)){

            $meetings = WikiAf5Meetings::query()
                ->orderBy('subjects','ASC')
                ->when($request->term, function ($query, $term ){
                    $query->where('subjects','LIKE','%' . $term . '%');})
                ->with('owner')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

            return Inertia::render('Meetings/Index', [
        
                'meetings' =>  $meetings,
                'paginator' =>WikiAf5Meetings::paginate(10)
            
            ]);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Devuelve todas los usuarios para cargar datatables vía ajax.
     * @author María Correa
     * @return array
     */
    public function data()
    {
        $slug_action = 'carga_lista_usuarios_reuniones';

        $data = [];
        
        $meeting_users = User::get();

        if(isset($_GET['id'])){

            $meetings = WikiAf5Meetings::find($_GET['id']);
        }
        

        foreach($meeting_users as $mu){

            $exists = false;

            if(isset($_GET['id'])){

                foreach($meetings->meeting_users as $user){

                    if($mu->id == $user->id){
                        $exists = true;
                    }
                }
            }
            
            if($exists){
                $checkbox =  ' <input type="checkbox" class="meeting_users" name="meeting_users[]" value="'.$mu->id.'" checked />';
            }else {
                $checkbox =  ' <input type="checkbox" class="meeting_users" name="meeting_users[]" value="'.$mu->id.'"/>';
            }
            
            
            $data[] = [
                $checkbox,
                $mu->firstname,
                $mu->lastname,
                $mu->userType->name,        
            ];
        }

            
        return json_encode(["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $slug_action = 'carga_form_creacion_reunion';

        if(Auth::user()->can_action($slug_action)){

            $users = User::where('user_type_id', 1)->get();
            $priorities = WikiAf5Priorities::all();
            
            return Inertia::render('Meetings/MeetingForm')->with('priorities', $priorities)->with('users', $users);

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
        $slug_action = 'guardar_form_creacion_reunion';

        if(Auth::user()->can_action($slug_action)){

            // $request->validate(
            //     [   
            //         'date' => 'required',
            //         'subjects' => 'required',
            //         'description' => 'required',
            //         'owner_id' => 'required',
            //         'priority_id' => 'required'
            //     ]
            // );

            // WikiAf5Meetings::create($request->all());
            $validated = $request->validate([
                'owner_id'     => 'required',
                'priority_id'  => 'required',
                'subjects'     => 'required',

            ]);
        
            $meeting = new WikiAf5Meetings;

            $meeting->owner_id      = $request->owner_id;
            $meeting->priority_id   = $request->priority_id;
            $meeting->date          = $request->date;
            $meeting->subjects      = $request->subjects;
            $meeting->description   = $request->description;

            $meeting->save();

            
            if(!is_null($request->meeting_users)){
                foreach ($request->meeting_users as $user){
                   
                    DB::table('wiki_af5_meetings_users')->insert([
                        'meeting_id' => $request->id,
                        'user_id' => $user,
                        'accept_invitation' => 'aceptada',
                        'status' => 1
                    ]);
                }
            }

            return Redirect::route('meetings')->with('success', '¡Reunión creada correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $slug_action = 'carga_vista_reunion';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['meeting']) && $request['meeting']) {

                $meeting_id = $request['meeting'];
                $meeting = WikiAf5Meetings::find($meeting_id);

                if (isset($meeting->id)){

                    $owner_id = $meeting->owner_id;
                    $owner = User::where('id', $owner_id)->get();
                    $priority_id = $meeting->priority_id;
                    $priority = WikiAf5Priorities::where('id', $priority_id)->get();

                    return Inertia::render('Meetings/Show', ['meeting' =>  $meeting, 'priority' => $priority, 'owner' => $owner]);
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
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $slug_action = 'carga_form_edicion_reunion';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['meeting']) && $request['meeting']) {

                $meeting_id = $request['meeting'];
                $meeting = WikiAf5Meetings::find($meeting_id);

                if (isset($meeting->id)){

                    $owners = User::where('user_type_id', 1)->get();
                    $priorities = WikiAf5Priorities::all();

                    return Inertia::render('Meetings/MeetingEditForm', ['meeting' =>  $meeting, 'priorities' => $priorities, 'owners' => $owners, 'id' => $id]);
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
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slug_action = 'guardar_form_edicion_reunion';

        if(Auth::user()->can_action($slug_action)){

            $validated = $request->validate([
                'owner_id'     => 'required',
                'date'         => 'required',
                'priority_id'  => 'required',
                'subjects'     => 'required',

            ]);
        
            $meeting = WikiAf5Meetings::find($id);

            $meeting->owner_id      = $request->owner_id;
            $meeting->priority_id   = $request->priority_id;
            $meeting->date          = $request->date;
            $meeting->subjects      = $request->subjects;
            $meeting->description   = $request->description;

            $meeting->save();
            // dd($meeting->meeting_users);
            foreach($meeting->meeting_users as $user){
                DB::table('wiki_af5_meetings_users')->where('meeting_id', $id)->delete();
            }
            
            if(!is_null($request->meeting_users)){
                foreach ($request->meeting_users as $user){
                   
                    DB::table('wiki_af5_meetings_users')->insert([
                        'meeting_id' => $id,
                        'user_id' => $user,
                        'accept_invitation' => 'aceptada',
                        'status' => 1
                    ]);
                }
            }

           

            return Redirect::route('meetings')->with('success', '¡Reunión editada correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_reunion';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['meeting']) && $request['meeting']) {

                $meeting_id = $request['meeting'];
                $meeting = WikiAf5Meetings::find($meeting_id);

                if (isset($meeting->id)){

                    $meeting->delete();

                    return redirect()->back()->with('success', 'Reunión borrada correctamente');
                }
            } 
            abort(404);   
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
