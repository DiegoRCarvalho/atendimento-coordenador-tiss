<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Free Routes
|--------------------------------------------------------------------------
|   EN: Routes that are accessed by unlogged users.
|   PT-BR: Rotas que são acessadas por usuários não logados.
*/
Route::get('/','LoginController@index')->name('index');
Route::post('/login','LoginController@store')->name('login');
Route::get('/sair', 'LogoutController@index')->name('logout');

/*
|--------------------------------------------------------------------------
| Fallback Routes
|--------------------------------------------------------------------------
|   EN: If the system receives an invalid route redirect to login page.
|
|   PT-BR: Se o sistema receber uma rota inválida redireciona para página de login.
*/
Route::fallback(function(){
    return redirect()->route('index');
});


/*
|--------------------------------------------------------------------------
| Home Group Routes
|--------------------------------------------------------------------------
|   EN: Group of routes that handle the HomeController.
|   PT-BR: Grupo de rotas que manipulam o HomeController.
*/
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::get('home', 'HomeController@index')->name('home');
});

/*
|--------------------------------------------------------------------------
| Attendance Group Routes
|--------------------------------------------------------------------------
|   EN: Group of routes that handle the AttendanceController.
|   PT-BR: Grupo de rotas que manipulam o AttendanceController.
*/
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::post('atendimento/getCpfCnpj', 'AttendanceController@getCpfCnpj')->name('attendance.getCpfCnpj');
});
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::resource('atendimento', 'AttendanceController')->names([
            'index'       => 'attendance.index',
            'store'       => 'attendance.store',
            'create'      => 'attendance.create',
            'show'        => 'attendance.show',
            'update'      => 'attendance.update',
            'destroy'     => 'attendance.destroy',
            'edit'        => 'attendance.edit',
        ]);
});


/*
|--------------------------------------------------------------------------
| Profile Group Routes
|--------------------------------------------------------------------------
|   EN: Group of routes that handle the ProfileController.
|   PT-BR: Grupo de rotas que manipulam o ProfileController.
*/
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::resource('perfil', 'ProfileController')->names([
            'index'       => 'profile.index',
            'store'       => 'profile.store',
            'create'      => 'profile.create',
            'show'        => 'profile.show',
            'update'      => 'profile.update',
            'destroy'     => 'profile.destroy',
            'edit'        => 'profile.edit',
        ]);
});

/*
|--------------------------------------------------------------------------
| Search Group Routes
|--------------------------------------------------------------------------
|   EN: Group of routes that handle the SearchController.
|   PT-BR: Grupo de rotas que manipulam o SearchController.
*/
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::post('pesquisar/lista', 'SearchController@list')->name('search.list');
});
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::resource('pesquisar', 'SearchController')->names([
        'index'       => 'search.index',
        'store'       => 'search.store',
        'create'      => 'search.create',
        'show'        => 'search.show',
        'update'      => 'search.update',
        'destroy'     => 'search.destroy',
        'edit'        => 'search.edit',
    ]);
});

/*
|--------------------------------------------------------------------------
| Report Group Routes
|--------------------------------------------------------------------------
|   EN: Group of routes that handle the ReportController.
|   PT-BR: Grupo de rotas que manipulam o ReportController.
*/
Route::group(['namespace' => 'Authenticated',  'middleware' => ['throttle:15,1', 'auth'], 'as' => 'authenticated.'], function(){
    Route::get('relatorio', 'ReportController@index')->name('report');
});
