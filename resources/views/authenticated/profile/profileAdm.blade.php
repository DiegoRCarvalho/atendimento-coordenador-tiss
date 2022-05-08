@extends('authenticated.master/master')

@section('brand')Editar Usuários @endsection

@section('title')Perfil @endsection

@section('content')
<div class="container" >
    <table class="table table-hover table-striped table-sm border mt-4">
        <thead class="bg-primary text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Matrícula</th>
                <th scope="col">Nome</th>
                <th scope="col">Acesso</th>
                <th scope="col">Setor</th>
                <th colspan="2" style="text-align:center;">
                    <input type="submit" onclick="addUser();" name="addUser" class="btn btn-success btn-sm" value="Adicionar Novo Usuário"/>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                @php
                    $checkUser = (($loggedInUser['id']) == ($item->id));
                @endphp
                <tr {{($checkUser) ? 'class= bg-info' : ''}}>
                    <td>{{$item->id}}</td>
                    <td>{{$item->registration}}</td>
                    <td>{{$item->first_name.' '.$item->last_name}}</td>
                    <td>{{($item->level == 1) ? 'Administrador' : 'Usuário'}}</td>
                    <td>{{$item->description}}</td>
                    <td style="text-align:center;">
                        @if ($checkUser)
                            <input type="submit" class="btn btn-outline-secondary btn-sm" disabled value="Remover"/>
                        @else
                            <form action="{{route('authenticated.profile.destroy', $item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" id="deleteUser" name="deleteUser" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        <form action="{{route('authenticated.profile.edit',$item->id)}}" method="GET">
                            @csrf
                            @method('PUT')
                            <button type="submit" id="editUser" name="editUser" class="btn btn-warning text-dark btn-sm">Editar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    function addUser() {
        document.getElementById("addUser");
        document.location.href="{{ route('authenticated.profile.create') }}";
    }
</script>
@endsection
