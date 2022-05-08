@extends('authenticated.master/master')

@section('css')

<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">


@endsection

@section('brand')Novo Atendimento @endsection

@section('title')Novo Atendimento @endsection

@section('content')
    <div class="container mt-2" >

        @if ($store === true)
            <div class="form-row">
                <div class="alert alert-success col-12" role="alert">
                    {{$message}}
                </div>
            </div>
        @elseif ($store === false)
            <div class="form-row">
                <div class="alert alert-danger col-12" role="alert">
                    {{$message}}
                </div>
            </div>
        @endif

        <form name="attendance" action="{{route('authenticated.attendance.store')}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-2">
                    <label for="cpfCnpj">* CPF / CNPJ</label>
                    <input type="number" class="form-control form-control-sm" id="cpfCnpj" name="cpfCnpj"
                           data-action="{{route('authenticated.attendance.getCpfCnpj')}}"
                           value="{{old('cpfCnpj')}}" autofill="on" required>
                </div>
                <fieldset disabled class="col-8">
                    <div class="form-group" >
                        <label for="providerName">Nome do Prestador</label>
                        <input type="text" class="form-control form-control-sm" id="providerName" name="providerName">
                    </div>
                </fieldset>
                <fieldset disabled class="col-2">
                    <div class="form-group" >
                        <label for="protocol">Protocolo</label>
                        <input type="text" class="form-control form-control-sm" id="protocol" name="protocol">
                    </div>
                </fieldset>
            </div>

            <div class="form-row">
                <fieldset disabled class="col-2">
                    <div class="form-group">
                        <label for="typeProvider">Tipo</label>
                        <input type="text" class="form-control form-control-sm" id="typeProvider" name="typeProvider">
                    </div>
                </fieldset>
                <fieldset disabled class="col-10">
                    <div class="form-group" >
                        <label for="providerAddress">Endereço</label>
                        <input type="text" class="form-control form-control-sm" id="providerAddress" name="providerAddress">
                    </div>
                </fieldset>
            </div>
            <div class="form-row col-12 p-0">
                <div class="col-10 p-0">
                        <div class="form-row">
                            <fieldset disabled class="col-2">
                                <div class="form-group" >
                                    <label for="registeredContact">Contato</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredContact" name="registeredContact">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-2">
                                <div class="form-group" >
                                    <label for="registeredSector">Setor</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredSector" name="registeredSector">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-3">
                                <div class="form-group" >
                                    <label for="registeredPhone">(DDD) Telefone / Ramal</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredPhone" name="registeredPhone">
                                </div>
                            </fieldset>
                            <fieldset disabled class="col-5">
                                <div class="form-group" >
                                    <label for="registeredEmail">Email</label>
                                    <input type="text" class="form-control form-control-sm" id="registeredEmail" name="registeredEmail">
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-6">
                            <label for="contact">Contato</label>
                            <input type="text" class="form-control form-control-sm" id="contact"
                                   name="contact" value="{{old('contact')}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="sector">Setor</label>
                            <input type="text" class="form-control form-control-sm" id="sector"
                                name="sector" value="{{old('sector')}}">
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-1">
                                <label for="ddd">DDD</label>
                                <input type="number" class="form-control form-control-sm" id="ddd"
                                       name="ddd" value="{{old('ddd')}}">
                            </div>
                            <div class="form-group col-3">
                                <label for="firstPhone">Telefone</label>
                                <input type="number" class="form-control form-control-sm" id="firstPhone"
                                       name="firstPhone" value="{{old('firstPhone')}}">
                            </div>
                            <div class="form-group col-2">
                                <label for="firstPhoneExtension">Ramal</label>
                                <input type="number" class="form-control form-control-sm" id="firstPhoneExtension"
                                       name="firstPhoneExtension" value="{{old('firstPhoneExtension')}}">
                            </div>
                            <div class="form-group col-6">
                                <label for="firstEmail">Email</label>
                                <input type="email" class="form-control form-control-sm" id="firstEmail"
                                       name="firstEmail" aria-describedby="emailHelp" value="{{old('firstEmail')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-5">
                                <label for="errorDetails">* Detalhe do erro</label>
                                  <select id="errorDetails" class="form-control form-control-sm" name="errorDetails" required>
                                        <option>Escolher...</option>
                                            @foreach ($error_details as $item)
                                                <option value="{{$item->id}}" {{old('errorDetails') == $item->id ? 'selected' : ''}}>{{$item->description}}</option>
                                            @endforeach
                                        </select>

                            </div>
                            <div class="form-group col-5">
                                <label for="solutionDetails">Solução</label>
                                    <select id="solutionDetails" class="form-control form-control-sm" name="solutionDetails">
                                        <option>Escolher...</option>
                                        @foreach ($solution_details as $item)
                                            <option value="{{$item->id}}" {{old('solutionDetails') == $item->id ? 'selected' : ''}}>{{$item->description}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-2">
                                <label for="forwardTo">Encaminhar para</label>
                                    <select id="forwardTo" class="form-control form-control-sm" name="forwardTo">
                                        <option>Escolher...</option>
                                        @foreach ($forwardTo as $item)
                                           <option value="{{$item['userId']}}" {{old('forwardTo') == $item['userId'] ? 'selected' : ''}}>{{$item['userDepartments']}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="note">Observação</label>
                                <textarea class="form-control form-control-sm" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div>

                </div>
                <div class="col-2 rightSidebar pl-3">
                    <div class="form-group">
                        <h6>Protocolos Anteriores</h6>
                        <div class="protocolList">
                            <ul name="protocolList" id="protocolList" style="list-style-type: none;">

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
    <script >
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){
        $('#cpfCnpj').blur(function(){
            var cpfCnpj = $(this);
            $.post(cpfCnpj.data('action'),{cpfCnpj: cpfCnpj.val()}, function(response){
                if (response.dataResponse == null) {
                    $('input[name="providerName"]').val('');
                    $('input[name="typeProvider"]').val('');
                    $('input[name="providerAddress"]').val('');
                    $('input[name="registeredPhone"]').val('');
                    $('input[name="registeredEmail"]').val('');
                    $('input[name="protocol"]').val('');
                    $('input[name="contact"]').val('');
                    $('input[name="sector"]').val('');
                    $('input[name="ddd"]').val('');
                    $('input[name="firstPhone"]').val('');
                    $('input[name="firstPhoneExtension"]').val('');
                    $('input[name="firstEmail"]').val('');

                } else {
                    $('input[name="providerName"]').val(response.dataResponse.company_fancy_name);
                    $('input[name="typeProvider"]').val(response.dataResponse.type);
                    $('input[name="providerAddress"]').val(response.dataResponse.providerAddress);
                    $('input[name="registeredPhone"]').val(response.dataResponse.registeredPhone);
                    $('input[name="registeredContact"]').val(response.dataResponse.registeredContact);
                    $('input[name="registeredSector"]').val(response.dataResponse.registeredSector);
                    $('input[name="registeredEmail"]').val(response.dataResponse.registeredEmail);
                    $('li[name="li"]').remove();
                    if ((response.dataResponse.protocolList) != null) {
                        var array = response.dataResponse.protocolList;
                        $.each(array , function(index, element) {
                            $('ul[name="protocolList"]').append("<li name='li' ><a target='_blank' href={{route('authenticated.attendance.edit',["index"])}} style='text-decoration:none;'>"+element+"</a></li>");
                        });
                    }
                }
            }, 'json');
        })
    });
    </script>
@endsection
