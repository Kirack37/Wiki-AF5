<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5WebServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'methods',
        'url',
        'data_headers',
        'data_request_type',
        'data_request',
        'data_response',
    ];

    public function projects(){
        return $this->belongsTo(WikiAf5Projects::class, 'project_id');
    }
}
