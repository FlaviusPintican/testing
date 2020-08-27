<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Film;
use App\Services\FilmService;
use Laravel\Lumen\Http\Request;

class FilmController extends Controller
{
    /**
     * @var FilmService
     */
    private FilmService $filmService;

    /**
     * @param FilmService $filmService
     */
    public function __construct(FilmService $filmService)
    {
        $this->filmService = $filmService;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function getFilms(Request $request) : array
    {
        return $this->filmService->getFilms($request);
    }

    /**
     * @param int $id
     *
     * @return Film
     */
    public function getFilm(int $id) : Film
    {
        return $this->filmService->getFilm($id);
    }
}
