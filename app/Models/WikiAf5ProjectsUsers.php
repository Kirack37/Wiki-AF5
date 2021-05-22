<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ProjectsUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'user_id',
        'accept_invitation',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects(){
        return $this->belongsTo(WikiAf5Meetings::class, 'project_id');
    }
}
