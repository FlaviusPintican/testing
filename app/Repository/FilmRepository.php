<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FilmRepository
{
    /**
     * @return int
     */
    public function getNrFilms() : int
    {
        return Film::count();
    }

    /**
     * @param array $film
     *
     * @return Film
     */
    public function createFilm(array $film) : Film
    {
        return Film::create($film);
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return Film[]
     */
    public function getFilms(int $offset, int $limit) : array
    {
        return Film::offset($offset)->limit($limit)->with(['images', 'videos'])->get()->all();
    }

    /**
     * @param int $id
     * @throws ModelNotFoundException
     *
     * @return Film
     */
    public function getFilm(int $id) : Film
    {
        return Film::with(['images', 'videos'])->findOrFail($id);
    }
}
