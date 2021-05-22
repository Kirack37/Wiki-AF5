<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Role;
use App\Models\WikiAf5Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $slug_action = 'listado_roles';

        if(Auth::user()->can_action($slug_action)){

            $roles = WikiAf5Role::query()
                ->orderBy('name','ASC')
                ->when($request->term, function ($query, $term ){
                    $query->where('name','LIKE','%' . $term . '%');})
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

            return Inertia::render('Roles/Index', [
        
                'roles' =>  $roles,
                'paginator' =>WikiAf5Role::paginate(10)
            
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
    public function datausers()
    {
        $slug_action = 'carga_lista_usuarios_roles';

        if(Auth::user()->can_action($slug_action)){

            $data = [];
            
            $all_users = User::get();

            if(isset($_GET['id'])){

                $roles = WikiAf5Role::find($_GET['id']);
            }
            

            foreach($all_users as $ru){

                $exists = false;

                if(isset($_GET['id'])){

                    foreach($roles->all_users as $user){

                        if($ru->id == $user->id){
                            $exists = true;
                        }
                    }
                }
                
                if($exists){
                    $checkbox =  ' <input type="checkbox" class="all_users" name="all_users[]" value="'.$ru->id.'" checked />';
                }else {
                    $checkbox =  ' <input type="checkbox" class="all_users" name="all_users[]" value="'.$ru->id.'"/>';
                }
                
                
                $data[] = [
                    $checkbox,
                    $ru->firstname,
                    $ru->lastname,
                    $ru->user_type->name,        
                ];
            }

                
            return json_encode(["data" => $data]);
        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

     /**
     * Devuelve todas los permisos para cargar datatables vía ajax.
     * @author María Correa
     * @return array
     */
    public function datapermissions()
    {
        $slug_action = 'carga_lista_permisos_roles';

        if(Auth::user()->can_action($slug_action)){

            $data = [];
            
            $permissions =  WikiAf5Permission::get();

            if(isset($_GET['id'])){

                $roles = WikiAf5Role::find($_GET['id']);
            }
            

            foreach($permissions as $rp){

                $exists = false;

                if(isset($_GET['id'])){

                    foreach($roles->permissions as $permission){

                        if($rp->id == $permission->id){
                            $exists = true;
                        }
                    }
                }
                
                if($exists){
                    $checkbox =  ' <input type="checkbox" class="permissions" name="permissions[]" value="'.$rp->id.'" checked />';
                }else {
                    $checkbox =  ' <input type="checkbox" class="permissions" name="permissions[]" value="'.$rp->id.'"/>';
                }
                
                
                $data[] = [
                    $checkbox,
                    $rp->id,
                    $rp->name,
                    $rp->description,      
                ];
            }

                
            return json_encode(["data" => $data]);
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

            return Inertia::render('Roles/RoleForm')->with('status', '¡Rol creado correctamente!');

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

            $request->validate(
                [   
                    'name' => 'required',
                    'slug' => 'required',
                    'description' => 'required',

                ]
            );

            WikiAf5Role::create($request->all());

            if(!is_null($request->all_users)){
                foreach ($request->all_users as $user){
                   
                    DB::table('wiki_af5_role_user')->insert([
                        'role_id' => $request->id,
                        'user_id' => $user,
                    ]);
                }
            }

            return Redirect::route('roles')->with('success', '¡Rol creado correctamente!');

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
    public function edit(Request $request, $id)
    {
        $slug_action = 'carga_form_edicion_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    return Inertia::render('Roles/RoleEditForm', ['role' =>  $role, 'id' => $id]);
                }
            } 
            abort(404);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    public function editusers(Request $request, $id)
    {
        $slug_action = 'carga_form_edicion_usuario_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    return Inertia::render('Roles/RoleUserEditForm', ['role' =>  $role, 'id' => $id]);
                }
            } 
            abort(404);

        }else{
            return redirect('dashboard')->with('status', 'No tienes permiso para acceder.');
        }
    }

    public function editpermissions(Request $request, $id)
    {
        $slug_action = 'carga_form_edicion_permiso_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    return Inertia::render('Roles/RolePermissionEditForm', ['role' =>  $role, 'id' => $id]);
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
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slug_action = 'guardar_form_edicion_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    $role->update($request->all());

                    foreach($role->all_users as $user){
                        DB::table('wiki_af5_role_user')->where('role_id', $id)->delete();
                    }
                    
                    if(!is_null($request->all_users)){
                        foreach ($request->all_users as $user){
                           
                            DB::table('wiki_af5_role_user')->insert([
                                'role_id' => $id,
                                'user_id' => $user,
                            ]);
                        }
                    }

                    foreach($role->permissions as $permission){
                        DB::table('wiki_af5_roles_permissions')->where('role_id', $id)->delete();
                    }
                    
                    if(!is_null($request->permissions)){
                        foreach ($request->permissions as $permission){
                           
                            DB::table('wiki_af5_roles_permissions')->insert([
                                'role_id' => $id,
                                'permission_id' => $permission,
                            ]);
                        }
                    }
        

                    return Redirect::route('roles')->with('success', '¡Rol editado correctamente!');
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
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function updateusers(Request $request, $id)
    {
        $slug_action = 'guardar_form_edicion_usuario_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    foreach($role->all_users as $user){
                        DB::table('wiki_af5_role_user')->where('role_id', $id)->delete();
                    }
                    
                    if(!is_null($request->all_users)){
                        foreach ($request->all_users as $user){
                           
                            DB::table('wiki_af5_role_user')->insert([
                                'role_id' => $id,
                                'user_id' => $user,
                            ]);
                        }
                    }
      

                    return Redirect::route('roles')->with('success', '¡Usuarios asociados al rol editados correctamente!');
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
     * @param  \App\Models\WikiAf5Role  $wikiAf5Role
     * @return \Illuminate\Http\Response
     */
    public function updatepermissions(Request $request, $id)
    {
        $slug_action = 'guardar_form_edicion_permisos_rol';

        if(Auth::user()->can_action($slug_action)){

            if (isset($request['role']) && $request['role']) {

                $role_id = $request['role'];
                $role = WikiAf5Role::find($role_id);

                if (isset($role->id)){

                    foreach($role->permissions as $permission){
                        DB::table('wiki_af5_roles_permissions')->where('role_id', $id)->delete();
                    }
                    
                    if(!is_null($request->permissions)){
                        foreach ($request->permissions as $permission){
                           
                            DB::table('wiki_af5_roles_permissions')->insert([
                                'role_id' => $id,
                                'permission_id' => $permission,
                            ]);
                        }
                    }
      

                    return Redirect::route('roles')->with('success', '¡Permisos asociados al rol editados correctamente!');
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
