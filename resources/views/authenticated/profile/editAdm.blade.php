@extends('authenticated.master/master')

@section('brand')Editar Usuário @endsection

@section('title')Editar Usuário @endsection

@section('css') <link rel="stylesheet" href="{{ asset('css/editProfile.css') }}"> @endsection

@section('content')
<div class="container userFormEdit">
    <form name="editAdm" action="{{ route('authenticated.profile.update' , $register->id ) }}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group row">
            <label for="registration" class="col-sm-4 col-form-label">Matrícula</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="registration" value="{{$register->registration}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="firstName" class="col-sm-4 col-form-label">Nome</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="firstName" value="{{$register->first_name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="lastName" class="col-sm-4 col-form-label">Sobrenome</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="lastName" value="{{$register->last_name}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="department" class="col-sm-4 col-form-label">Departamento</label>
            <div class="col-sm-8">
                <select id="department" name="department" class="form-control">
                    <option selected>{{$register->description}}</option>
                    @foreach ($departments as $item)
                        <option>{{$item->description}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="level" class="col-sm-4 col-form-label">Acesso</label>
            <div class="col-sm-8">
                <select id="level" name="level" class="form-control">
                    <option selected>{{($register->level == 1) ? 'Administrador' : 'Usuário'}}</option>
                    <option>{{($register->level == 2) ? 'Administrador' : 'Usuário'}}</option>
                </select>
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
            <button type="submit" class="btn btn-success btn-block">Alterar</button>
        </div>
    </form>
    <a  href="{{ route('authenticated.profile.index') }}" type="button" class="btn btn-secondary btn-block">Voltar</a>
</div>
@endsection

