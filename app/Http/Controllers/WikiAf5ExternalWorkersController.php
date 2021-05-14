<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5ExternalWorkers;
use App\Models\User;
use App\Models\WikiAf5Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class WikiAf5ExternalWorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $users = User::all();
        $slug_action = 'listado_trabajadores_externos';

        if(Auth::user()->can_action($slug_action)){

            $workers = WikiAf5ExternalWorkers::query()
                ->orderBy('user_id', 'ASC')
                ->when($request->term, function ($query, $term ){
                    $query->where('company_id','LIKE','%' . $term . '%');})
                ->with('user')
                ->with('company')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

            // $workers = WikiAf5ExternalWorkers::query()
            // ->join('users','users.id','=','wiki_af5_external_workers.user_id')
            //     ->where('users.firstname', 'LIKE', '%' . $request->term . '%')
            //     //->orderBy('users.name', 'ASC')
            //     ->with('user')
            //     ->with('company')
            //     ->paginate(10)
            //     ->withQueryString()
            //     ->sortBy('users.firstname');

            return Inertia::render('ExternalWorkers/Index', [
        
                'workers' =>  $workers,
                'paginator' =>WikiAf5ExternalWorkers::paginate(10)
            
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
        $slug_action = 'carga_form_creacion_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            $users = User::where('user_type_id', 3)->get();
            $companies = WikiAf5Company::all();
            return Inertia::render('ExternalWorkers/WorkerForm')->with('users', $users)->with('companies', $companies);

            
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
        $slug_action = 'guardar_form_creacion_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'user_id' => 'required',
                ]
            );

            WikiAf5ExternalWorkers::create($request->all());

            return Redirect::route('externalworkers')->with('success', '¡Trabajador externo creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5ExternalWorkers  $wikiAf5ExternalWorkers
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $slug_action = 'carga_vista_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['externalworker']) && $request['externalworker']) {

                $worker_id = $request['externalworker'];
                $worker = WikiAf5ExternalWorkers::find($worker_id);

                if (isset($worker->id)){

                    $user_id = $worker->user_id;
                    $users = User::where('id', $user_id)->get();
                    $company_id = $worker->company_id;
                    $companies = WikiAf5Company::where('id', $company_id)->get();

                    return Inertia::render('ExternalWorkers/Show', ['worker' =>  $worker, 'users' => $users, 'companies' => $companies]);
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
     * @param  \App\Models\WikiAf5ExternalWorkers  $wikiAf5ExternalWorkers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['externalworker']) && $request['externalworker']) {

                $worker_id = $request['externalworker'];
                $worker = WikiAf5ExternalWorkers::find($worker_id);
                
                if (isset($worker->id)){

                    $users = User::where('user_type_id', 3)->get();
                    $companies = WikiAf5Company::all();

                    return Inertia::render('ExternalWorkers/WorkerEditForm', ['worker' =>  $worker, 'users' => $users, 'companies' => $companies]);
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
     * @param  \App\Models\WikiAf5ExternalWorkers  $wikiAf5ExternalWorkers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slug_action = 'guardar_form_edicion_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['externalworker']) && $request['externalworker']) {

                $worker_id = $request['externalworker'];
                $worker = WikiAf5ExternalWorkers::find($worker_id);

                if (isset($worker->id)){

                    $worker->update($request->all());

                    return Redirect::route('externalworkers')->with('success', '¡Trabajador externo editado correctamente!');
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
     * @param  \App\Models\WikiAf5ExternalWorkers  $wikiAf5ExternalWorkers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_trabajador_externo';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['externalworker']) && $request['externalworker']) {

                $worker_id = $request['externalworker'];
                $worker = WikiAf5ExternalWorkers::find($worker_id);

                if (isset($worker->id)){

                    $worker->delete();

                    return redirect()->back()->with('success', 'Trabajador externo borrado correctamente');
                }
            } 
            abort(404);  
            
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
