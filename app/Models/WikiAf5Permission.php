<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;

class WikiAf5Permission extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_permissions';

     /**
     * Al invocar esta función desde una acción obtienes el listado de roles que pueden realizar dicha acción.
     * $permission->roles;
     * @author María Correa
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'wiki_af5_roles_permissions', 'permission_id', 'role_id')->withTimestamps();
    }

}
