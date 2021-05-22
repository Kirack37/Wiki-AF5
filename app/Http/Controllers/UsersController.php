<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WikiAf5Company;
use App\Models\WikiAf5Contact;
use App\Models\WikiAf5UsersType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;



class UsersController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_usuarios';

        if(Auth::user()->can_action($slug_action)){

            $users = User::query()
                ->orderBy('name','ASC')
                ->when($request->term, function ($query, $term ){
                    $query->where('firstname', 'LIKE', '%' . $term . '%')->orWhere('lastname', 'LIKE', '%' . $term . '%');})
                ->with('user_type')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

            return Inertia::render('Users/Index', [
        
                'users' =>  $users,
                'paginator' =>User::paginate(10)
            
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
        $slug_action = 'cargar_registro_usuarios';

        if(Auth::user()->can_action($slug_action)){

            $users_type = WikiAf5UsersType::get();

            return Inertia::render('Users/UserForm', ['usersType' => $users_type]);

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
        $slug_action = 'crear_usuario';

            if(Auth::user()->can_action($slug_action)){

                $request->validate([

                    'firstname' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'user_type_id' => ['required'],
                    'password' => $this->passwordRules(),
                ]);

                $user = new User;

                $user->user_type_id      = $request->user_type_id;
                $user->firstname         = $request->firstname;
                $user->lastname          = $request->lastname;
                $user->name              = $request->name;
                $user->email             = $request->email;
                $user->password          = Hash::make($request->password);

                $user->save();
        
                // $data = $request->all();
                // $check = $this->create($data);
                // User::create($request->all());

            return Redirect::route('wikiusers')->with('success', '¡Usuario creado correctamente!');

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $slug_action = 'carga_vista_usuario';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['wikiuser']) && $request['wikiuser']) {

                $user_id = $request['wikiuser'];
                $currentUser = User::find($user_id);
                $user_type_id = $currentUser->user_type_id;
                $user_type = WikiAf5UsersType::where('id', $user_type_id)->get();
                // $contact = WikiAf5Contact::where('id', $user_id)->get('id');

                // dd($user_type);
                if (isset($currentUser->id)){
                   
                    return Inertia::render('Users/Show', ['currentUser' =>  $currentUser, 'user_type' => $user_type]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $slug_action = 'carga_form_edicion_usuario';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['wikiuser']) && $request['wikiuser']) {

                $user_id = $request['wikiuser'];
                $currentUser = User::find($user_id);
                $user_type = WikiAf5UsersType::get();

                if (isset($currentUser->id)){

                    return Inertia::render('Users/UserEditForm', ['currentUser' =>  $currentUser, 'user_type' => $user_type]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slug_action = 'guardar_form_edicion_usuario';

        if(Auth::user()->can_action($slug_action)){

   
            $validated = $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'user_type_id' => ['required'],

            ]);
        
            $user = User::find($id);

            $user->user_type_id      = $request->user_type_id;
            $user->firstname         = $request->firstname;
            $user->lastname          = $request->lastname;
            $user->name              = $request->name;
            $user->email             = $request->email;

            $user->save();    

            return Redirect::route('wikiusers')->with('success', '¡Usuario editado correctamente!');
        

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $slug_action = 'eliminar_usuario';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['wikiuser']) && $request['wikiuser']) {

                $user_id = $request['wikiuser'];
                $currentUser = User::find($user_id);

                if (isset($currentUser->id)){

                    foreach($currentUser->roles as $user){
                        DB::table('wiki_af5_role_user')->where('user_id', $user_id)->delete();
                    }

                    $currentUser->delete();

                    return redirect()->back()->with('success', 'Usuario borrado correctamente');
                }
            } 
            abort(404);  
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }
}
