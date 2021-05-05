<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectsTrello extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_projects_trello';

    protected $fillable = [
        'project_enviroment_id',
        'url',
        'username',
        'password',
    ];

    public function enviroments(){
        return $this->belongsTo(WikiAf5ProjectsEnviroments::class, 'project_enviroment_id');
    }
}
