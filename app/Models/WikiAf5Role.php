<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\WikiAf5Permission;

class WikiAf5Role extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_roles';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Al invocar esta función desde un rol obtienes el listado de usuarios que tienen dicho rol.
     * $role->users;
     * @author María Correa
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'wiki_af5_role_user', 'role_id', 'user_id')->withTimestamps();
    }

     /**
     * Al invocar esta función desde un rol obtienes el listado de permisos que tiene dicho rol.
     * $role->permissions;
     * @author María Correa
     */
    public function permissions()
    {
        return $this->belongsToMany(WikiAf5Permission::class, 'wiki_af5_roles_permissions', 'role_id', 'permission_id')->withTimestamps();
    }

}
