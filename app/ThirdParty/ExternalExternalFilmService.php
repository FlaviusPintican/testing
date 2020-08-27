<?php declare(strict_types=1);

namespace App\ThirdParty;

use App\Dto\FilmDto;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExternalExternalFilmService implements ExternalFilmServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function getFilms(): array
    {
        $body = Client::getResponse( env('MG_TECH_BASE_URL') . '/files/showcase.json')->body();

        try {
            $films = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            if ($exception->getCode() === JSON_ERROR_UTF8) {
                Log::warning($exception->getMessage());
                $films = json_decode(utf8_decode($body), true, JSON_THROW_ON_ERROR);
            }
        } finally {
            $films = $films ?? [];
        }

        return $this->mapFilms($films);
    }

    /**
     * @param array $films
     *
     * @return FilmDto[]
     */
    private function mapFilms(array $films): array
    {
        $nrFilms = count($films);
        $filmsList = [];

        foreach ($films as $key => $film) {
            $id = $key + 1;
            Log::info("Import film $id/$nrFilms");
            $filmsList[] = new FilmDto($film);
        }

        return $filmsList;
    }
}
