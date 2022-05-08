<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <title>ACT | Login</title>
</head>
<body>

    <div class="limiter">

		<div class="left-sidebar">
            <h1>Atendimento Coordenador TISS</h1>
            <img src="images/logo.png" alt="Logo Atendimento Coordenador TISS" class="img-responsive">
        </div>

        <div class="right-sidebar">
            <div class="container">
                <form class="form-login" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2>Acesse o sistema</h2>
                    <div class="form-group">
                        <input class="form-control" type="text" name="registration" placeholder="Matrícula">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-success btn-block mb-3">Entrar</button>
                </form>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

