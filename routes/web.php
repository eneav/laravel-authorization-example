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
/**
 * @var \Illuminate\Routing\Router $router
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$router->group(['middleware' => 'auth'], function () use ($router) {
    // App
    $router->get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Articles
    $router->group(['prefix' => 'articles'], function () use ($router) {
        $router->get('/', 'Articles\IndexController@index')->name('articles.index');

        $router->get('create', 'Articles\CreateController@create')->name('articles.create')->middleware('authenticated.can:create-articles');
        $router->post('store', 'Articles\CreateController@store')->name('articles.store')->middleware('authenticated.can:create-articles');

        $router->get('{article}/edit', 'Articles\UpdateController@edit')->name('articles.edit')->middleware('authenticated.can:modify-articles');
        $router->patch('{article}/update', 'Articles\UpdateController@update')->name('articles.update')->middleware('authenticated.can:modify-articles');

        $router->get('{article}/delete', 'Articles\DeleteController@delete')->name('articles.delete')->middleware('authenticated.can:destroy-articles');
        $router->delete('{article}/destroy', 'Articles\DeleteController@destroy')->name('articles.destroy')->middleware('authenticated.can:destroy-articles');
    });
});

$router->get('unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');
