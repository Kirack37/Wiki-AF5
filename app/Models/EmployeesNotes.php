<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesNotes extends Model
{
    use HasFactory;

    protected $table = 'wiki_af5_employees_notes';

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
