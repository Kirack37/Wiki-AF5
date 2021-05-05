<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectsPhase extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_projects_phase';

    public function enviroments(){
        return $this->belongsTo(WikiAf5ProjectsEnviroments::class, 'project_enviroment_id');
    }
}
