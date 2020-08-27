<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Film;
use App\Repository\FilmRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Http\Request;

class FilmService implements FilmServiceInterface
{
    /**
     * @var FilmRepository
     */
    private FilmRepository $filmRepository;

    /**
     * @param FilmRepository $filmRepository
     */
    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function createFilm(array $film) : Film
    {
        return $this->filmRepository->createFilm($film);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilms(Request $request) : array
    {
        $films = $this->filmRepository->getFilms(
            $request->query->get('offset', 0),
            $request->query->get('limit', 10),
        );

        foreach ($films as $film) {
            foreach ($film->images as $image) {
                $image->url = $this->getImage($image->url);
            }
        }

        return $films;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilm(int $id) : Film
    {
        $film = $this->filmRepository->getFilm($id);

        foreach ($film->images as $image) {
            $image->url = $this->getImage($image->url);
        }

        return $film;
    }

    /**
     * @param string $imageUrl
     *
     * @return string
     */
    private function getImage(string $imageUrl) : string
    {
        $hash = $this->getHash($imageUrl);

        if ($location = Cache::get("image-$hash")) {
           return $location;
        }

        return $this->cacheImage($imageUrl, $hash);
    }

    /**
     * @param string $imageUrl
     * @param string $hash
     *
     * @return string
     */
    private function cacheImage(string $imageUrl, string $hash) : string
    {
        $location = Storage::url("images/$hash.jpg");

        Storage::put($location, file_get_contents($imageUrl));
        Cache::put("image-$hash", $location, 3600);

        return $location;
    }

    /**
     * @param string $imageUrl
     *
     * @return string
     */
    private function getHash(string $imageUrl) : string
    {
        return sha1($imageUrl);
    }
}
