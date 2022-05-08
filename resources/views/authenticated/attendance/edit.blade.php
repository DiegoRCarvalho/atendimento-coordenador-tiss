@extends('authenticated.master/master')

@section('css')

<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">


@endsection

@section('brand')Editar Atendimento @endsection

@section('title')Editar Atendimento @endsection

@section('content')
    <div class="container mt-2" >

        <div class="form-row">
            <div class="alert alert-warning col-12" role="alert" style="text-align:center;" name="message">Atendimento em andamento</div>
        </div>

        <form name="attendance" action="{{route('authenticated.attendance.update', [$attendanceId])}}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-row">
                <fieldset disabled class="col-2">
                    <div class="form-group">
                        <label for="cpfCnpj">CPF / CNPJ</label>
                        <input type="number" class="form-control form-control-sm" id="cpfCnpj" name="cpfCnpj"
                            value="{{$query['cpf_cnpj']}}">
                    </div>
                </fieldset>
                <fieldset disabled class="col-8">
                    <div class="form-group" >
                        <label for="providerName">Nome do Prestador</label>
                        <input type="text" class="form-control form-control-sm" id="providerName" name="providerName"
                            value="{{$query['company_fancy_name']}}">
                    </div>
                </fieldset>
                <fieldset disabled class="col-2">
                    <div class="form-group" >
                        <label for="protocol">Protocolo</label>
                        <input type="text" class="form-control form-control-sm protocol border border-success" id="protocol" name="protocol"
                            value="{{$query['protocol']}}">
                    </div>
                </fieldset>
            </div>

            <div class="form-row">
                <fieldset disabled class="col-2">
                    <div class="form-group">
                        <label for="typeProvider">Tipo</label>
                        <input type="text" class="form-control form-control-sm" id="typeProvider" name="typeProvider"
                            value="{{$query['type']}}">
                    </div>
                </fieldset>
                <fieldset disabled class="col-10">
                    <div class="form-group" >
                        <label for="providerAddress">Endereço</label>
                        <input type="text" class="form-control form-control-sm" id="providerAddress" name="providerAddress"
                            value="{{$query['address']}}">
                    </div>
                </fieldset>
            </div>
            <div class="form-row col-12 p-0">
                <div class="col-10 p-0">
                        <div class="form-row">
                            <fieldset disabled class="col-2">
                                <div class="form-group" >
                                    <label for="registeredContact">Contato</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredContact" name="registeredContact"
                                        value="{{$query['register_contact']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-2">
                                <div class="form-group" >
                                    <label for="registeredSector">Setor</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredSector" name="registeredSector"
                                        value="{{$query['register_sector']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-3">
                                <div class="form-group" >
                                    <label for="registeredPhone">(DDD) Telefone / Ramal</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredPhone" name="registeredPhone"
                                        value="{{$query['register_telephone']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-5">
                                <div class="form-group" >
                                    <label for="registeredEmail">Email</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredEmail" name="registeredEmail"
                                        value="{{$query['register_email']}}">
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-row">
                            <fieldset disabled class="col-6">
                                <div class="form-group">
                                    <label for="contact">Contato</label>
                                    <input type="text" class="form-control form-control-sm" id="contact"
                                        name="contact" value="{{$query['contact']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-6">
                                <div class="form-group">
                                    <label for="sector">Setor</label>
                                    <input type="text" class="form-control form-control-sm" id="sector"
                                        name="sector" value="{{$query['sector']}}">
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-row">
                            <fieldset disabled class="col-1">
                                <div class="form-group">
                                    <label for="ddd">DDD</label>
                                    <input type="number" class="form-control form-control-sm" id="ddd"
                                        name="ddd" value="{{$query['ddd']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-3">
                                <div class="form-group">
                                    <label for="firstPhone">Telefone</label>
                                    <input type="number" class="form-control form-control-sm" id="firstPhone"
                                        name="firstPhone" value="{{$query['telephone']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-2">
                                <div class="form-group">
                                    <label for="firstPhoneExtension">Ramal</label>
                                    <input type="number" class="form-control form-control-sm" id="firstPhoneExtension"
                                        name="firstPhoneExtension" value="{{$query['telefone_extension']}}">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-6">
                                <div class="form-group">
                                    <label for="firstEmail">Email</label>
                                    <input type="email" class="form-control form-control-sm" id="firstEmail"
                                        name="firstEmail" aria-describedby="emailHelp" value="{{$query['email']}}">
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-5">
                                <label for="errorDetails">* Detalhe do erro</label>
                                  <select id="errorDetails" class="form-control form-control-sm" name="errorDetails" required>
                                        <option selected value={{$query['error_id']}}>{{($query['error_detail'] == null) ? 'Escolher...' : $query['error_detail']}}</option>
                                            @foreach ($error_details as $item)
                                                <option value="{{$item->id}}">{{$item->description}}</option>
                                            @endforeach
                                        </select>

                            </div>
                            <div class="form-group col-5">
                                <label for="solutionDetails">Solução</label>
                                    <select id="solutionDetails" class="form-control form-control-sm" name="solutionDetails">
                                        <option selected value={{$query['solution_id']}}>{{($query['solution_detail'] == null) ? 'Escolher...' : $query['solution_detail']}}</option>
                                        @foreach ($solution_details as $item)
                                            <option value="{{$item->id}}">{{$item->description}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="forwardTo">Encaminhar para</label>
                                    <select id="forwardTo" class="form-control form-control-sm" name="forwardTo">
                                        <option value="">Escolher...</option>
                                        <option selected value={{$query['forward_id']}}>{{($query['forward_to'] == null) ? 'Escolher...' : $query['forward_to']}}</option>
                                        @foreach ($forwardTo as $item)
                                            <option value="{{$item['userId']}}">{{$item['userDepartments']}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="note">Observação</label>
                                <textarea class="form-control form-control-sm" id="note" name="note" rows="3">{{$query['note']}}</textarea>
                            </div>
                        </div>

                </div>
                <div class="col-2 rightSidebar pl-3">
                    <div class="form-group">
                        <h6>Protocolos Anteriores</h6>
                        <div class="protocolList" name="protocolList" id="protocolList">
                            <ul style="list-style-type: none;">
                                @foreach ($protocols as $item)
                                    <li><a target="_blank" href="{{route('authenticated.attendance.edit', [$item->attendance_fk])}}" style="text-decoration: none;">{{$item->protocol}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Gravar</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('div[name="message"]').hide( 3000, function() {
                $(this).remove();
        });
    </script>
@endsection
