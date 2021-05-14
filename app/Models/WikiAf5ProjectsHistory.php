<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class WikiAf5ProjectsHistory extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_projects_history';

    protected $fillable = [
        'project_id',
        'user_id',
        'description',
        'title',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function projects(){
        return $this->belongsTo(WikiAf5Projects::class, 'project_id');
    }
}

