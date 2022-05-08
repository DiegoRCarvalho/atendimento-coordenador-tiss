@extends('authenticated.master/master')

@section('brand')Criar Usuário @endsection

@section('title')Criar Usuário @endsection

@section('css') <link rel="stylesheet" href="{{ asset('css/editProfile.css') }}"> @endsection

@section('content')
<div class="container userFormEdit mt-5">
    <form name="createProfile" action="{{route('authenticated.profile.store')}}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="registration" class="col-sm-4 col-form-label">Matrícula</label>
            <div class="col-sm-8">
                <input type="text" class="form-control registration" id="registration" name="registration">
            </div>
        </div>
        <div class="form-group row">
            <label for="firstName" class="col-sm-4 col-form-label">Nome</label>
            <div class="col-sm-8">
                <input type="text" class="form-control firstName" id="firstName" name="firstName">
            </div>
        </div>
        <div class="form-group row">
            <label for="lastName" class="col-sm-4 col-form-label">Sobrenome</label>
            <div class="col-sm-8">
                <input type="text" class="form-control lastName" id="lastName" name="lastName">
            </div>
        </div>
        <div class="form-group row">
            <label for="department" class="col-sm-4 col-form-label">Departamento</label>
            <div class="col-sm-8">
                <select id="department" name="department" class="form-control">
                    <option selected> </option>
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
                    <option selected> </option>
                    <option>Usuário</option>
                    <option>Administrador</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-sm-4 col-form-label">Senha</label>
          <div class="col-sm-8">
            <input type="password" class="form-control password" id="password" name="password">
          </div>
        </div>
        <div class="form-group row">
          <label for="confirmPassword" class="col-sm-4 col-form-label">Confirmar senha</label>
          <div class="col-sm-8">
            <input type="password" class="form-control password" id="confirmPassword" name="confirmPassword">
          </div>
        </div>
        <button type="submit" class="btn btn-success btn-block">Criar</button>
        <input type="submit" onclick="backTo();" name="backTo" class="btn btn-secondary btn-block" value="Voltar"/>
    </form>
</div>
@endsection

@section('script')
<script>
    function backTo() {
        document.getElementById("backTo");
        document.location.href="{{ route('authenticated.profile.index') }}";
    }
</script>
@endsection
