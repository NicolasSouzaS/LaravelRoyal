<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamento';

    protected $fillable = [
        'funcionario_id',
        'cliente_id',
        'servico_id',
        'horario_id',
        'dataAgendamento',
    ];
}
