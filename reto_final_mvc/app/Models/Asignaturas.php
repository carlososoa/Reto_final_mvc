<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'semestre',
        'cantidad_de_creditos',
        'id_del_docente',
        'horas_de_trabajo_autonomo',
        'horas_de_trabajo_dirigido',
    ];
}
