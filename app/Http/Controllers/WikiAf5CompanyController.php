<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_empresas';

        $companies = WikiAf5Company::query()
        ->orderBy('name','ASC')
        ->when($request->term, function ($query, $term ){
            $query->where('name','LIKE','%' . $term . '%');})
        ->paginate(10)
        ->withQueryString()
        ->sortBy('name');

    return Inertia::render('Companies/Index', [
   
        'companies' =>  $companies,
        'paginator' =>WikiAf5Company::paginate(10)
      
     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slug_action = 'carga_form_creacion_empresa';

        return Inertia::render('Companies/CompanyForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $slug_action = 'guardar_form_creacion_empresa';

        $request->validate(
            [   
                'name' => 'required',
                'description' => 'required',
            ]
        );

        WikiAf5Company::create($request->all());

        return Redirect::route('companies')->with('success', '¡Empresa creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $slug_action = 'carga_vista_empresa';

        if (isset($request['company']) && $request['company']) {

            $company_id = $request['company'];
            $company = WikiAf5Company::find($company_id);

            if (isset($company->id)){
        
                return Inertia::render('Companies/Show', ['company' =>  $company]);
            }
        } 
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_empresa';

        if (isset($request['company']) && $request['company']) {

            $company_id = $request['company'];
            $company = WikiAf5Company::find($company_id);

            if (isset($company->id)){
                
                return Inertia::render('Companies/CompanyEditForm', ['company' =>  $company]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $slug_action = 'guardar_form_edicion_empresa';

        if (isset($request['company']) && $request['company']) {

            $company_id = $request['company'];
            $company = WikiAf5Company::find($company_id);

            if (isset($company->id)){

                $company->update($request->all());
                return Redirect::route('companies')->with('success', '¡Empresa editada correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Company  $wikiAf5Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_empresa';

        if (isset($request['company']) && $request['company']) {

            $company_id = $request['company'];
            $company = WikiAf5Company::find($company_id);

            if (isset($company->id)){

                $company->delete();
                return redirect()->back()->with('success', 'Empresa borrada correctamente');
            }
        } 
        abort(404);        
    }
}
