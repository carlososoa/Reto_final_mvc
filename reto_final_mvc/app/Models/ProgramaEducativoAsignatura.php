<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaEducativoAsignatura extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'programa_educativo_id',
        'asignatura_id'
        
    ];
}
