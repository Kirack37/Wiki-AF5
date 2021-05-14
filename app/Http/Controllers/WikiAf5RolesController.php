<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slug_action = 'listado_roles';

        if(Auth::user()->can_action($slug_action)){

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
        $slug_action = 'carga_form_creacion_rol';

        if(Auth::user()->can_action($slug_action)){

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
        $slug_action = 'guardar_form_creacion_rol';

        if(Auth::user()->can_action($slug_action)){

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Role $wikiAf5Role)
    {
        $slug_action = 'carga_vista_rol';

        if(Auth::user()->can_action($slug_action)){

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function edit(WikiAf5Role $wikiAf5Role)
    {
        $slug_action = 'carga_form_edicion_rol';

        if(Auth::user()->can_action($slug_action)){

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WikiAf5Role $wikiAf5Role)
    {
        $slug_action = 'guardar_form_edicion_rol';

        if(Auth::user()->can_action($slug_action)){

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Role $wikiAf5Role)
    {
        $slug_action = 'eliminar_rol';

        if(Auth::user()->can_action($slug_action)){

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
