<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_contactos';

        $contacts = WikiAf5Contact::query()
            ->orderBy('user_id','ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('user_id','LIKE','%' . $term . '%');})
            ->with('user')
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');

        return Inertia::render('Contacts/Index', [
       
            'contacts' =>  $contacts,
            'paginator' =>WikiAf5Contact::paginate(10)
          
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $slug_action = 'carga_form_creacion_contacto';

        $users = User::where('user_type_id', '>', 1)->get();
        
        return Inertia::render('Contacts/ContactForm')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $slug_action = 'guardar_form_creacion_contacto';

        $request->validate(
            [   
                'type' => 'required',
                'value' => 'required',
                'user_id' => 'required',
            ]
        );

        WikiAf5Contact::create($request->all());

        return Redirect::route('contacts')->with('success', '¡Contacto creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Contact  $wikiAf5Contact
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        $slug_action = 'carga_vista_contacto';

        // if (isset($request['contact']) && $request['contact']) {

            // $contact_id = $request['contact'];
            // $contact = WikiAf5Contact::find($contact_id);
            // dd($contact);
            // // if (isset($contact->id)){

            //     $user_id = $contact->user_id;
            //     $users = User::where('id', $user_id)->get();
            //     $contacts = WikiAf5Contact::where('id', $user_id)->get();

            //     return Inertia::render('Contacts/Show', ['contacts' =>  $contacts, 'users' => $users]);
        //     }
        // } 
        // abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Contact  $wikiAf5Contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_contacto';

        if (isset($request['contact']) && $request['contact']) {

            $contact_id = $request['contact'];
            $contact = WikiAf5Contact::find($contact_id);

            if (isset($contact->id)){

                $users = User::where('user_type_id', '>', 1)->get();

                return Inertia::render('Contacts/ContactEditForm', ['contact' =>  $contact, 'users' => $users]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Contact  $wikiAf5Contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        $slug_action = 'guardar_form_edicion_contacto';

        if (isset($request['contact']) && $request['contact']) {

            $contact_id = $request['contact'];
            $contact = WikiAf5Contact::find($contact_id);

            if (isset($contact->id)){

                $contact->update($request->all());

                return Redirect::route('contacts')->with('success', '¡Contacto editado correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Contact  $wikiAf5Contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slug_action = 'eliminar_contacto';

        if (isset($request['contact']) && $request['contact']) {

            $contact_id = $request['contact'];
            $contact = WikiAf5Contact::find($contact_id);

            if (isset($contact->id)){

                $contact->delete();

                return redirect()->back()->with('success', 'Cliente borrado correctamente');
            }
        } 
        abort(404);        
    }
}
