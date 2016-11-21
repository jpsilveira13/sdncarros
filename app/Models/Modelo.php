<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{

    protected $table = "fp_modeloSDN";

    protected $fillable = [
        'codigo_modelo',
        'codigo_marca',
        'codigo_fipe',
        'modelo',
    ];

}
