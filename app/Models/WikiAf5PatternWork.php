<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WikiAf5PatternWork extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_pattern_work';

    protected $fillable = [
        'name',
        'project_type',
        'patterns',
    ];
}
