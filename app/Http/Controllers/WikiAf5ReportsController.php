<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Reports;
use App\Models\WikiAf5Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $slug_action = 'listado_actas';

        if(Auth::user()->can_action($slug_action)){

            $meetings = WikiAf5Meetings::where('id', $id)->get();
            $reports = WikiAf5Reports::where('meeting_id' , $id)
                    ->orderBy('created_at', 'asc')
                    ->when($request->term, function ($query, $term ){
                        $query->where('subjects','LIKE','%' . $term . '%');})
                    ->with('client')
                    ->with('meetings')
                    ->paginate(10)
                    ->withQueryString()
                    ->sortBy('name');

            return Inertia::render('MeetingsReports/Index', [
                'meetings' => $meetings,
                'reports' =>  $reports,
                'paginator' =>WikiAf5Reports::paginate(10)
        
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
        $slug_action = 'carga_form_creacion_acta';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $meetings = WikiAf5Meetings::where('id', $id)->get();

            return Inertia::render('MeetingsReports/ReportForm', ['meetings' => $meetings, 'user_id' => $user_id]);

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
        $slug_action = 'guardar_form_creacion_acta';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'description' => 'required',
                ]
            );

            WikiAf5Reports::create($request->all());

            return Redirect::route('reports.index', $id)->with('success', '¡Acta de la reunión creada correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Reports  $wikiAf5Reports
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Reports $wikiAf5Reports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Reports  $wikiAf5Reports
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $slug_action = 'carga_form_edicion_acta';

        if(Auth::user()->can_action($slug_action)){

            $user_id = Auth::id();
            $meeting = WikiAf5Meetings::where('id', $id)->get();
            
            if (isset($request['report']) && $request['report']) {
                $report_id = $request['report'];
                $report = WikiAf5Reports::find($report_id);

                if (isset($report->id)){
                    
                    return Inertia::render('MeetingsReports/ReportEditForm', ['meeting' =>  $meeting, 'report' => $report, 'user_id' => $user_id]);
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
     * @param  \App\Models\WikiAf5Reports  $wikiAf5Reports
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $slug_action = 'guardar_form_edicion_acta';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['report']) && $request['report']) {

                $report_id = $request['report'];
                $report = WikiAf5Reports::find($report_id);

                if (isset($report->id)){

                    $report->update($request->all());

                    return Redirect::route('reports.index', $id)->with('success', '¡Acta de la reunión editada correctamente!');
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
     * @param  \App\Models\WikiAf5Reports  $wikiAf5Reports
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slug_action = 'eliminar_acta';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['report']) && $request['report']) {

                $report_id = $request['report'];
                $report = WikiAf5Reports::find($report_id);

                if (isset($report->id)){

                    $report->delete();

                    return redirect()->back()->with('success', 'Acta de la reunión borrada correctamente');
                }
            } 
            abort(404);  
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
