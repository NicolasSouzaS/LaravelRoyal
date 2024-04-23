<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    // Campos editáveis no banco de dados - Processo do dashboard
    protected $fillable = [
        'fotoFuncionario',
        'nomeFuncionario',
        'sobrenomeFuncionario',
        'emailFuncionario',
        'numeroFuncionario',
        'especialidadeFuncionario',
        'inicioExpedienteFuncionario',
        'fimExpedienteFuncionario',
        'cargoFuncionario',
        'valorCorteFuncionario',
        'qntCortesFuncionario',
        'salarioFuncionario',
        'statusFuncionario',
    ];

    // Identificação de usuário - Processo do Login
    public function usuario(){
        return $this->morphOne(Usuario::class, 'tipo_usuario');
    }

    public function Regras(){
        return[
            'nomeFuncionario' => 'required|unique:funcionarios,nomeFuncionario,'.$this->id.'|min:3',
            // 'fotoAluno' => 'required'
            'fotoFuncionario' => 'required|file|mimes:png,jpg',
            'sobrenomeFuncionario' => 'required',
            'numeroFuncionario' => 'required',
            'emailFuncionario' => 'required',
            'especialidadeFuncionario' => 'required',
            'inicioExpedienteFuncionario' => 'required',
            'fimExpedienteFuncionario' => 'required',
            'cargoFuncionario' => 'required',
            'qntCortesFuncionario' => 'required',
            'statusFuncionario' => 'required'
        ];
    }

    public function Feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'fotoFuncionario.mimes' => 'O arquivo deve ser uma imagem PNG ou JPG',
            'nomeFuncionario.unique' => 'O nome do serviço já existe',
            'nomeFuncionario.min' => 'O nome do serviço deve ter mais de 3 caracteres'
            ];
        }
}
