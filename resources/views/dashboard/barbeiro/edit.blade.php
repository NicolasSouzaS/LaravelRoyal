@extends('dashboard.layout-dash.layout')

@section('title', 'Peril Barbeiro')

@section('conteudo')

<section class="main">

    <div>
        <h2 class="titulo">Edite seu perfil</span> </h2>
        <form action="{{ route('barbeiro.perfil.update', $funcionario->id) }}" method="POST" class="formulario">

            @csrf

            @method('PUT')


            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="nomeFuncionario">Nome:</label>
                    <input type="text" class="form-control" @error('nomeFuncionario') is-invalid @enderror
                        id="nomeFuncionario" name="nomeFuncionario" required value="{{ $funcionario->nomeFuncionario }}"
                        maxlength="100">
                    @error('nomeFuncionario')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="sobrenomeFuncionario">Sobrenome:</label>
                    <input type="text" class="form-control" @error('sobrenomeFuncionario') is-invalid @enderror
                        id="sobrenomeFuncionario" name="sobrenomeFuncionario" required value="{{ $funcionario->sobrenomeFuncionario }}"
                        maxlength="100">
                    @error('sobrenomeFuncionario')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="numeroFuncionario">Número:</label>
                    <input type="number" class="form-control" @error('numeroFuncionario') is-invalid @enderror
                        id="numeroFuncionario" name="numeroFuncionario"
                        value="{{ $funcionario->numeroFuncionario }}" required>
                    @error('numeroFuncionario')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-group">
                <label for="emailFuncionario">Email:</label>
                <input type="email" class="form-control" @error('emailFuncionario') is-invalid @enderror
                    id="emailFuncionario" name="emailFuncionario"
                    value="{{ $funcionario->emailFuncionario }}" required>
                </select>

                @error('emailFuncionario')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="botoes">
                <div class="col-md-12">
                    <a href="{{ route('dashboard.perfil') }}" class="btn btn-primary desativar">voltar</a>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary enviar">enviar</button>
                </div>
            </div>
        </form>
    </div>

</section>

