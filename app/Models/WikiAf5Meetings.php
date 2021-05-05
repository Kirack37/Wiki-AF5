<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function users(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function priority(){
        return $this->belongsTo(WikiAf5Priorities::class);
    }
}
