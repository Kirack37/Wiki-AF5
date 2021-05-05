<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5Reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        // 'client_id',
        'aprobbed',
        'publication',
        'description'
    ];

    public function client(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meetings(){
        return $this->belongsTo(WikiAf5Meetings::class, 'meeting_id');
    }
}
