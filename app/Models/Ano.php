<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ano extends Model
{

    protected $table = "fp_anoSDN";

    protected $fillable = [
        'id_ano',
        'codigo_modelo',
        'codigo_fipe',
        'ano',
        'combustivel',
        'valor',
    ];

}
