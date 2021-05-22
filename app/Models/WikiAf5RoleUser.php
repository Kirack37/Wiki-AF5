<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5RoleUser extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_role_user';

    protected $fillable = [
        'user_id',
        'role_id'

    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles(){
        return $this->belongsTo(WikiAf5Role::class, 'role_id');
    }
}
