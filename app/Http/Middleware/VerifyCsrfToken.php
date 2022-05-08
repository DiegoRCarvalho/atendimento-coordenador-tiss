<?php

namespace act\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
     protected $except = [
    //     '/',
    //     '/login',
    //     '/sair',
    //     '/home',
    //     '/perfil',
    //     '/pesquisar',
    //     '/relatorio',
    //     '/atendimento/index',
    //     '/atendimento/store',
    //     '/atendimento/create',
         '/atendimento/getCpfCnpj',
    //     '/atendimento/show',
    //     '/atendimento/update',
    //     '/atendimento/destroy',
    //     '/atendimento/edit',
    ];
}
