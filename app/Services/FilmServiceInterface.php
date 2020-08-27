<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Film;
use Laravel\Lumen\Http\Request;

interface FilmServiceInterface
{
    /**
     * @param array $film
     *
     * @return Film
     */
    public function createFilm(array $film) : Film;

    /**
     * {@inheritDoc}
     */
    public function getFilms(Request $request) : array;

    /**
     * {@inheritDoc}
     */
    public function getFilm(int $id) : Film;
}
