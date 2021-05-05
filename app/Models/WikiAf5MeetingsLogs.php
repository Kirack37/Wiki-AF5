<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5MeetingsLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'message',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function meetings(){
        return $this->belongsTo(WikiAf5Meetings::class, 'meeting_id');
    }
}
