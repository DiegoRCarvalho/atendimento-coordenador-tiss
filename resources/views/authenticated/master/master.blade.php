<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    @yield('css')
    @yield('scriptHead')

    <title>ACT | @yield('title')</title>
</head>
<body>
<nav class="navbar navbar-dark m-0 p-0">
    <a class="nav-link dropdown-toggle"
       href="#"
       id="navbarDropdown"
       role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"><label for="navbarDropdown"><img src="{{ asset('images/menu.png') }}" alt="menu"></label></a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="{{ route('authenticated.home') }}">Home</a>
      <a class="dropdown-item" href="{{ route('authenticated.attendance.create') }}">Novo Atendimento</a>
      <a class="dropdown-item" href="{{ route('authenticated.search.index') }}">Pesquisar</a>
      <a class="dropdown-item" href="{{ route('authenticated.profile.index') }}">Perfil</a>
      <a class="dropdown-item" href="{{ route('authenticated.report') }}">Relatórios</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('logout') }}">Sair</a>
    </div>

    <div class="col-10">
        <div class="col-12">
            <h5 style="text-align:right; position:fixed; margin-left:250px;"> @yield('brand') </h5>
            <h6 style="text-align:right; margin-right:0;">{{$userLog['first_name'].' '.$userLog['last_name']. ' - '. date('d/m/Y - H:i:s')}}</h6>
        </div>
    </div>
</nav>

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')

</body>
</html>
