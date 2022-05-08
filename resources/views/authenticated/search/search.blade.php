@extends('authenticated.master/master')

@section('brand')Pesquisar @endsection

@section('title')Pesquisar @endsection

@section('css') <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
<div class="container userFormEdit mt-5">
    <form name="search" action="{{route('authenticated.search.list')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="cpfCnpj" class="col-sm-3 col-form-label">CPF ou CNPJ</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="cpfCnpj">
            </div>
        </div>
        <div class="form-group row">
            <label for="protocol" class="col-sm-3 col-form-label">Protocolo</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="protocol">
            </div>
        </div>
        <div class="form-group row">
          <label for="period" class="col-sm-3 col-form-label">Período</label>
          <div class="col-sm-9 row">
            <div class="col-sm-6">
                <span>Data Início</span>
                <input type="text" id="datepicker" class="form-control" name="initialDate">
            </div>
            <div class="col-sm-6">
                <span>Data Fim</span>
                <input type="text" id="datepicker" class="form-control" name="finalDate">
            </div>
          </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>
        </div>
    </form>
</div>
@endsection
@section('script')

@endsection
