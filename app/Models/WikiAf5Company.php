<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5Company extends Model
{
    use HasFactory;
    protected $table = 'wiki_af5_company';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];
}
