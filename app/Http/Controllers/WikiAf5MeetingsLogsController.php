<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5MeetingsLogs;
use App\Models\WikiAf5Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5MeetingsLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_logs_reuniones';

        if(Auth::user()->can_action($slug_action)){

            $meetings = WikiAf5Meetings::where('id', $id)->get();
            $logs = WikiAf5MeetingsLogs::where('meeting_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('message','LIKE','%' . $term . '%');})
                    ->with('users')
                    ->with('meetings')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('MeetingsLogs/Index', [
                'meetings' => $meetings,
                'logs' =>  $logs,
                'paginator' =>WikiAf5MeetingsLogs::paginate(10)
        
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
        $slug_action = 'carga_form_creacion_log_reunion';

        if(Auth::user()->can_action($slug_action)){

            // $user_id = Auth::id();
            $meetings = WikiAf5Meetings::where('id', $id)->get();

            return Inertia::render('MeetingsLogs/LogForm', ['meetings' => $meetings]);

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
        $slug_action = 'guardar_form_creacion_log_reunion';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'message' => 'required',
                ]
            );

            WikiAf5MeetingsLogs::create($request->all());

            return Redirect::route('logs.index', $id)->with('success', '¡Log de la reunión creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsLogs  $wikiAf5MeetingsLogs
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5MeetingsLogs $wikiAf5MeetingsLogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsLogs  $wikiAf5MeetingsLogs
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_log_reunion';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $meeting = WikiAf5Meetings::where('id', $id)->get();
            
            if (isset($request['log']) && $request['log']) {
                $log_id = $request['log'];
                $log = WikiAf5MeetingsLogs::find($log_id);

                if (isset($log->id)){
                    
                    return Inertia::render('MeetingsLogs/LogEditForm', ['meeting' =>  $meeting, 'log' => $log, 'user_id' => $user_id]);
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
     * @param  \App\Models\WikiAf5MeetingsLogs  $wikiAf5MeetingsLogs
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_log_reunion';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['log']) && $request['log']) {

                $log_id = $request['log'];
                $log = WikiAf5MeetingsLogs::find($log_id);

                if (isset($log->id)){

                    $log->update($request->all());

                    return Redirect::route('logs.index', $id)->with('success', '¡Log de la reunión editado correctamente!');
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
     * @param  \App\Models\WikiAf5MeetingsLogs  $wikiAf5MeetingsLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_log_reunion';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['log']) && $request['log']) {

                $log_id = $request['log'];
                $log = WikiAf5MeetingsLogs::find($log_id);

                if (isset($log->id)){

                    $log->delete();
                    
                    return redirect()->back()->with('success', 'Log de historial borrado correctamente');
                }
            } 
            abort(404);
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
