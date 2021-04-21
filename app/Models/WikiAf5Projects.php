<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WikiAf5Projects extends Model
{   
    // use SoftDeletes;
    use HasFactory;
    
    protected $fillable = [
        'responsible_id',
        'priority_id',
        'start_date',
        'end_date',
        'description',
        'name',
        'alias',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'responsible_id');
    }
    public function priority(){
        return $this->belongsTo(WikiAf5Priorities::class);
    }
}
