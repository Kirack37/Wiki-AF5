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
        'responsible'
    ];

    public function scopeFilter($query, array $filters)
    {   
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
        });
    }
}
