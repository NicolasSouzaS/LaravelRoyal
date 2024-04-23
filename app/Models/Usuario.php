<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'senha','tipo_usuario_id','tipo_usuario_type', 'email_verificado_em', 'token_lembrete', 'criado_em', 'atualizado_em'];


    // Pegando o tipo do usuario(funcionário ou cliente ) e o id correspondente ao que há na tabela usuário.
    public function tipo_usuario(){
        return $this->morphTo('tipo_usuario', 'tipo_usuario_type', 'tipo_usuario_id');
    }


    // Sempre que for criado um novo registro, a coluna "token_lembrete" vai receber um valor aleatorio de 6 digitos.
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->token_lembrete = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        });
    }
}
