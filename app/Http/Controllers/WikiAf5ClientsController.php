<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Clients;
use App\Models\User;
use App\Models\WikiAf5Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


class WikiAf5ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_clientes';  

        if(Auth::user()->can_action($slug_action)){
        $users = User::all();
        // $sql = 'SELECT * FROM `wiki_af5_clients`
        // JOIN `users` ON `users`.id = `wiki_af5_clients`.user_id
        // ORDER BY `users`.name ASC';
        // $results = DB::select($sql, ['id' => 1]);

        $clients = WikiAf5Clients::query()
            ->orderBy('user_id', 'ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('company_id','LIKE','%' . $term . '%');})
            ->with('user')
            ->with('company')
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');

        // $clients = WikiAf5Clients::query()
	    // ->join('users','users.id','=','wiki_af5_clients.user_id')
        // ->when($request->term, function ($query, $term ){      
        //     $query->where('users.firstname', 'LIKE', '%' . $term . '%');})
        //     //->orderBy('users.name', 'ASC')
        //     ->with('user')
        //     ->with('company')
        //     ->paginate(10)
        //     ->withQueryString()
        //     ->sortBy('name');

        return Inertia::render('Clients/Index', [
       
            'clients' =>  $clients,
            'paginator' =>WikiAf5Clients::paginate(10)
          
        ]);

        }else{
            return Redirect::route('dashboard')->with('error', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slug_action = 'carga_form_creacion_cliente';

        if(Auth::user()->can_action($slug_action)){

            $users = User::where('user_type_id', 2)->get();
            $companies = WikiAf5Company::all();
            return Inertia::render('Clients/ClientForm')->with('users', $users)->with('companies', $companies);

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
        $slug_action = 'guardar_form_creacion_cliente';

            if(Auth::user()->can_action($slug_action)){

            $request->validate(
                [   
                    'user_id' => 'required',
                ]
            );

            WikiAf5Clients::create($request->all());

            return Redirect::route('clients')->with('success', '¡Cliente creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Clients  $wikiAf5Clients
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $slug_action = 'carga_vista_cliente';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['client']) && $request['client']) {

                $client_id = $request['client'];
                $client = WikiAf5Clients::find($client_id);

                if (isset($client->id)){

                    $user_id = $client->user_id;
                    $users = User::where('id', $user_id)->get();
                    $company_id = $client->company_id;
                    $companies = WikiAf5Company::where('id', $company_id)->get();

                    return Inertia::render('Clients/Show', ['client' =>  $client, 'users' => $users, 'companies' => $companies]);
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
     * @param  \App\Models\WikiAf5Clients  $wikiAf5Clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_cliente';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['client']) && $request['client']) {

                $client_id = $request['client'];
                $client = WikiAf5Clients::find($client_id);

                if (isset($client->id)){

                    $users = User::where('user_type_id', 2)->get();
                    $companies = WikiAf5Company::all();

                    return Inertia::render('Clients/ClientEditForm', ['client' =>  $client, 'users' => $users, 'companies' => $companies]);
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
     * @param  \App\Models\WikiAf5Clients  $wikiAf5Clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $slug_action = 'guardar_form_edicion_cliente';
        
        if(Auth::user()->can_action($slug_action)){

            if (isset($request['client']) && $request['client']) {

                $client_id = $request['client'];
                $client = WikiAf5Clients::find($client_id);

                if (isset($client->id)){

                    $client->update($request->all());
                    
                    return Redirect::route('clients')->with('success', '¡Cliente editado correctamente!');
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
     * @param  \App\Models\WikiAf5Clients  $wikiAf5Clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_cliente';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['client']) && $request['client']) {
                $client_id = $request['client'];
                $client = WikiAf5Clients::find($client_id);
                if (isset($client->id)){
                    $client->delete();
                    return redirect()->back()->with('success', 'Cliente borrado correctamente');
                }
            } 
            abort(404);  
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }   
    }
    
}
