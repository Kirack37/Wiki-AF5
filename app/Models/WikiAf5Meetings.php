<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WikiAf5Meetings extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'priority_id',
        'date',
        'subjects',
        'description',
        'status',
    ];

    public function meeting_users(){
        return $this->belongsToMany(User::class, 'wiki_af5_meetings_users', 'meeting_id', 'user_id');
    }
    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function priority(){
        return $this->belongsTo(WikiAf5Priorities::class);
    }
}
