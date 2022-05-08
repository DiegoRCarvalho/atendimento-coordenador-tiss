@extends('authenticated.master/master')

@section('brand')Editar Usuário @endsection

@section('title')Perfil @endsection

@section('content')
<div class="container" >
    <table class="table table-hover table-sm border mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">Matrícula</th>
                <th scope="col">Nome</th>
                <th scope="col">Acesso</th>
                <th scope="col">Setor</th>
                <th colspan="1"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$loggedInUser['registration']}}</td>
                <td>{{$loggedInUser['first_name'].' '.$loggedInUser['last_name']}}</td>
                <td>Usuário</td>
                <td>{{$loggedInUser['description']}}</td>
                <td colspan="1">
                    <form action="{{route('authenticated.profile.edit', $loggedInUser['id'])}}" method="GET">
                        <button type="submit" class="btn btn-warning text-dark btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
