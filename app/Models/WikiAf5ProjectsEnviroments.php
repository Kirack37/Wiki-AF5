<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectsEnviroments extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
    ];

    public function projects(){
        return $this->belongsTo(WikiAf5Projects::class, 'project_id');
    }
}
