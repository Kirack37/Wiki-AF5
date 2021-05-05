<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5ExternalWorkers extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_external_workers';

    protected $fillable = [
        'user_id',
        'company_id',
        'strengths',
        'weaknesses',
        'notes',
    ];

    public function company(){
        return $this->belongsTo(WikiAf5Company::class, 'company_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function contact(){
        return $this->hasOne(WikiAf5Contact::class, 'contact_id');
    }
}
