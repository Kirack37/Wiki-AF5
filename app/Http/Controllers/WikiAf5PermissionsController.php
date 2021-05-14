<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WikiAf5PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slug_action = 'listado_permisos';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slug_action = 'carga_form_creacion_permiso';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug_action = 'guardar_form_creacion_permiso';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Permission  $WikiAf5Permission
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5Permission $WikiAf5Permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Permission  $WikiAf5Permission
     * @return \Illuminate\Http\Response
     */
    public function edit(WikiAf5Permission $WikiAf5Permission)
    {
        $slug_action = 'carga_form_edicion_permiso';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Permission  $WikiAf5Permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WikiAf5Permission $WikiAf5Permission)
    {
        $slug_action = 'guardar_form_edicion_permiso';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Permission  $WikiAf5Permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(WikiAf5Permission $WikiAf5Permission)
    {
        $slug_action = 'eliminar_permiso';
    }
}
