<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{

    protected $table = "fp_marcaSDN";

    protected $fillable = [
        'id',
        'codigo_marca',
        'marca',
        'tipo',
    ];

}
