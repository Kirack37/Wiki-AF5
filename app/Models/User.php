<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

use App\Models\WikiAf5Meetings;



use DB;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;


    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'firstname', 'lastname', 'name', 'email', 'password', 'company_id', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    /**
     * Al invocar esta función desde un usuario obtienes el listado de roles del mismo.
     * $user->roles;
     * @author María Correa
     */
    public function roles()
    {
        return $this->belongsToMany(WikiAf5Role::class, 'wiki_af5_role_user', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Al invocar esta función desde un usuario obtienes el listado de roles del mismo.
     * $user->meetings;
     * @author María Correa
     */
    public function meetings()
    {
        return $this->belongsToMany(WikiAf5Meetings::class, 'wiki_af5_meetings_users', 'user_id', 'meeting_id')->withTimestamps();
    }

    /**
     * Al invocar esta función desde un usuario obtienes el listado de proyectos del mismo.
     * $user->WikiAf5Projects;
     * @author María Correa
     */
    public function WikiAf5Projects(){
        return $this->hasMany(WikiAf5Projects::class);
    }

    /**
     * Al invocar esta función desde un usuario obtienes el tipo de usuario del mismo.
     * $user->userType;
     * @author María Correa
     */
    public function userType(){
        return $this->belongsTo(WikiAf5UsersType::class);
    }

    /**
     * Al invocar esta función desde un usuario obtienes el listado de empresas del mismo.
     * $user->company;
     * @author María Correa
     */

    public function company(){
        return $this->belongsTo(WikiAf5Company::class);
    }

     /**
     * Devuelve si el usuario puede realizar la acción
     * $user->can_action();
     * @author María Correa
     * @param string slug
     * @return boolean
     */
    public function can_action($slug){

        $can = false;
        

        foreach($this->roles as $role){
            foreach($role->permissions as $permission){
                if($permission->slug == $slug){
                    $can = true;
                }
            }
            
        }

        return $can;
    }
}
