<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5Role extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_roles';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function permisions(){
        return $this->belongsToMany(WikiAf5Permissions::class, 'permission_id');
    }
}
