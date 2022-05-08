@extends('authenticated.master/master')

@section('brand')Atendimento Coordenador TISS @endsection

@section('title')Home @endsection

@section('content')

<div class="container mt-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a
                class="nav-item nav-link active"
                id="nav-openAttendances-tab"
                data-toggle="tab"
                href="#nav-openAttendances"
                role="tab"
                aria-controls="nav-openAttendances"
                aria-selected="true">Em andamento
            </a>
            <a
                class="nav-item nav-link"
                id="nav-recentAttendances-tab"
                data-toggle="tab"
                href="#nav-recentAttendances"
                role="tab"
                aria-controls="nav-recentAttendances"
                aria-selected="false">Recentes
            </a>
            <a
                class="nav-item nav-link"
                id="nav-attendancesForwardedToYou-tab"
                data-toggle="tab"
                href="#nav-attendancesForwardedToYou"
                role="tab"
                aria-controls="nav-attendancesForwardedToYou"
                aria-selected="false">Encaminhados para você
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-openAttendances" role="tabpanel" aria-labelledby="nav-openAttendances-tab">
            <table class="table table-hover table-striped table-sm border">
                <thead  class="table-primary">
                    <tr>
                        <th scope="col">Contato</th>
                        <th scope="col">CPF / CNPJ</th>
                        <th scope="col">Nome do Prestador</th>
                        <th scope="col">Protocolo</th>
                        <th scope="col">Aberto em</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($openAttendances) == 0)
                        <tr>
                            <td colspan="5">
                                Não há atendimentos em andamento.
                            </td>
                        </tr>
                    @endif
                    @foreach ($openAttendances as $item)
                        <tr>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->contact_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->cpf_cnpj}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->company_fancy_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->protocol}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{date( 'd/m/Y - H:i:s' , strtotime($item->created_at))}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-recentAttendances" role="tabpanel" aria-labelledby="nav-recentAttendances-tab">
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
                    @if (count($recentAttendances) == 0)
                        <tr>
                            <td colspan="6">
                                Não há atendimentos registrados.
                            </td>
                        </tr>
                    @endif
                    @foreach ($recentAttendances as $item)
                        <tr>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    style="color:grey;"
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->contact_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    style="color:grey;"
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->cpf_cnpj}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    style="color:grey;"
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->company_fancy_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    style="color:grey;"
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->protocol}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    style="color:grey;"
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
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
        </div>
        <div class="tab-pane fade" id="nav-attendancesForwardedToYou" role="tabpanel" aria-labelledby="nav-attendancesForwardedToYou-tab">
            <table class="table table-hover table-striped table-sm border">
                <thead  class="table-primary">
                    <tr>
                        <th scope="col">Contato</th>
                        <th scope="col">CPF / CNPJ</th>
                        <th scope="col">Nome do Prestador</th>
                        <th scope="col">Protocolo</th>
                        <th scope="col">Aberto em</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($attendancesForwardedToYou) == 0)
                        <tr>
                            <td colspan="5">
                                Não há atendimentos encaminhados para você.
                            </td>
                        </tr>
                    @endif
                    @foreach ($attendancesForwardedToYou as $item)
                        <tr>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->contact_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->cpf_cnpj}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->company_fancy_name}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{$item->protocol}}</a></td>
                            <td><a class="noDecoration"
                                @if ($item->action == 3)
                                    href="{{route('authenticated.attendance.show', [$item->id])}}"
                                @else
                                    href="{{route('authenticated.attendance.edit', [$item->id])}}"
                                @endif
                                >{{date( 'd/m/Y - H:i:s' , strtotime($item->created_at))}}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
