@extends('authenticated.master/master')

@section('brand')Resultados da pesquisa @endsection

@section('title')Resultados da pesquisa @endsection

@section('css') <link rel="stylesheet" href="{{ asset('css/search.css') }}"> @endsection

@section('content')
<div class="container mt-5">
    @if (!empty($results))
        <table class="table table-hover table-striped table-sm border">
            <thead  class="table-primary">
                <tr>
                    <th scope="col">Contato</th>
                    <th scope="col">CPF / CNPJ</th>
                    <th scope="col">Nome do Prestador</th>
                    <th scope="col">Protocolo</th>
                    <th scope="col">Aberto em</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (count($results) == 0)
                    <tr>
                        <td colspan="6">
                            Não foram localizados atendimentos com os parâmetros informados.
                        </td>
                    </tr>
                @endif
                @foreach ($results as $item)
                    <tr>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                    style="color:grey;"
                                    target="_blank" href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    target="_blank" href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{$item->contact_name}}</a></td>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                    style="color:grey;"
                                    target="_blank" href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    target="_blank" href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{$item->cpf_cnpj}}</a></td>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                style="color:grey;"
                                target="_blank" href="{{route('authenticated.attendance.show', [$item->id])}}"
                            @else
                                target="_blank" href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{$item->company_fancy_name}}</a></td>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                style="color:grey;"
                                target="_blank" href="{{route('authenticated.attendance.show', [$item->id])}}"
                            @else
                                target="_blank" href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{$item->protocol}}</a></td>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                style="color:grey;"
                                target="_blank" href="{{route('authenticated.attendance.show', [$item->id])}}"
                            @else
                                target="_blank" href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{date( 'd/m/Y - H:i:s' , strtotime($item->created_at))}}</a></td>
                        <td><a class="noDecoration"
                            @if ($item->action == 3)
                                style="color:grey;"
                                href="{{route('authenticated.attendance.show', [$item->id])}}"
                            @else
                                href="{{route('authenticated.attendance.edit', [$item->id])}}"
                            @endif
                        >{{$item->action == 3 ? 'Finalizado' : 'Em andamento'}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
                <a  href="{{ route('authenticated.search.index') }}" type="button" class="btn btn-secondary">Voltar</a>
        </div>
    @else
            <div class="alert alert-warning" role="alert">
                Não foram encotrados resultados para sua pesquisa.
            </div>
            <div>
                    <a  href="{{ route('authenticated.search.index') }}" type="button" class="btn btn-secondary">Voltar</a>
            </div>
    @endif
</div>
@endsection
