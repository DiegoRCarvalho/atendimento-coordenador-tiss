@extends('authenticated.master/master')

@section('brand')Editar Usuário @endsection

@section('title')Editar Usuário @endsection

@section('css') <link rel="stylesheet" href="{{ asset('css/editProfile.css') }}"> @endsection

@section('content')
<div class="container userFormEdit">
    <form name="edit" action="{{route('authenticated.profile.update', $register->id)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-group row">
            <label for="staticRegistration" class="col-sm-4 col-form-label">Matrícula</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticRegistration" value="{{$register->registration}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticFirstName" class="col-sm-4 col-form-label">Nome</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticFirstName" value="{{$register->first_name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLastName" class="col-sm-4 col-form-label">Sobrenome</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticLastName" value="{{$register->last_name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticDepartment" class="col-sm-4 col-form-label">Departamento</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticDepartment" value="{{$register->description}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLevel" class="col-sm-4 col-form-label">Acesso</label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticLevel" value="{{($register->level == 1) ? 'Administrador' : 'Usuário'}}">
            </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-4 col-form-label">Senha</label>
          <div class="col-sm-8">
            <input type="password" class="form-control password" name="inputPassword" placeholder="Senha">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputNewPassword" class="col-sm-4 col-form-label">Nova Senha</label>
          <div class="col-sm-8">
            <input type="password" class="form-control password" name="inputNewPassword" placeholder="Nova Senha">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputConfirmNewPassword" class="col-sm-4 col-form-label">Confirmar nova senha</label>
          <div class="col-sm-8">
            <input type="password" class="form-control password" name="inputConfirmNewPassword" placeholder="Confirmar nova senha">
          </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Alterar Senha</button>
        </div>
    </form>
    <a  href="{{ route('authenticated.profile.index') }}" type="button" class="btn btn-secondary btn-block">Voltar</a>
</div>
@endsection
