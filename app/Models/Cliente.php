<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    // Tornando as colunas editáveis e incrementáveis - Processo do dashboard
    protected $fillable = [
        'nomeCliente',
        'sobrenomeCliente',
        'emailCliente',
        'telefoneCliente',
        'enderecoCliente',
        'qntCortesCliente',
        'statusCliente',
    ];

    // Identificação de usuario - Processo de login
    public function usuario(){
        return $this->morphOne(Usuario::class,'tipo_usuario');
    }
}
