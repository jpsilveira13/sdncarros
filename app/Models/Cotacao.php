<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{

    protected $table = "cotacao_sdncar";

    protected $fillable = [
        'id',
        'marca',
        'modelo',
        'ano',
        'km',
        'valor',
        'valor_min',
        'valor_max',
        'nome',
        'email',
        'tel',
        'local',
        'data',
        'periodo',
    ];

}
