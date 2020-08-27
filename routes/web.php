<?php declare(strict_types=1);

use App\Http\Controllers\FilmController;
use Laravel\Lumen\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/films', function () use ($router) {
    /** @var FilmController $controller */
    $controller = $router->app->make(FilmController::class);
    $request = $router->app->make(Request::class);
    return $controller->getFilms($request);
});

$router->get('/films/{id:[0-9]+}', function (int $id) use ($router) {
    /** @var FilmController $controller */
    $controller = $router->app->make(FilmController::class);
    return $controller->getFilm($id);
});
