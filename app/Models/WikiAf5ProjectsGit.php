<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectsGit extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_projects_git';

    protected $fillable = [
        'project_enviroment_id',
        'repository_url',
        'repository_name',
    ];

    public function enviroments(){
        return $this->belongsTo(WikiAf5ProjectsEnviroments::class, 'project_enviroment_id');
    }
}
