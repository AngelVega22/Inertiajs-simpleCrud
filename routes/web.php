<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Inicio');
});

Route::get('/usuarios', function () {
    // sleep(2);

    return Inertia::render('Users',[
        'users' =>  App\Models\User::query()
        ->when(Request::input('search'), function ($query, $search){
            $query -> where('name', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->withQueryString()
         ->through(fn($user) => [
            'id' => $user -> id ,
            'name' => $user ->name,
            'email' => $user -> email
         ]),
         'filters' => Request::only(['search'])
    ]);

});

Route::get('/configuracion', function () {
    return Inertia::render('Configuracion');
});

Route::post('/logout', function () {
dd(request('foo'));
});