<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5Contact extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_contact';

    protected $fillable = [
        'user_id',
        'type',
        'value',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
