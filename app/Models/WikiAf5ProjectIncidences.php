<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectIncidences extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_project_incidences';

    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
        'reason',
        'solution',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function projects(){
        return $this->belongsTo(WikiAf5Projects::class);
    }
}
