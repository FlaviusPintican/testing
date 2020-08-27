<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\Dto\FilmDto;
use App\Models\Film;
use App\Services\FilmService;
use App\Services\ImageService;
use App\Services\VideoService;
use App\ThirdParty\ExternalExternalFilmService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class ImportFilms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-films';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import films from third-party app';

    /**
     * Execute the console command.
     *
     * @param ExternalExternalFilmService $externalFilmService
     * @param FilmService                 $filmService
     * @param ImageService                $imageService
     * @param VideoService                $videoService
     *
     * @return void
     */
    public function handle(
        ExternalExternalFilmService $externalFilmService,
        FilmService $filmService,
        ImageService $imageService,
        VideoService $videoService
    ) : void {
        if (Film::count() > 0) {
            Log::warning('Films are already imported. You can import films only once!');
            return;
        }

        $films = $externalFilmService->getFilms();
        $bar = $this->output->createProgressBar(count($films));

        foreach ($films as $externalFilm) {
            try {
                $film = $filmService->createFilm($externalFilm->toArray());
                $this->createImages($imageService, $externalFilm, $film->id);
                $this->createVideos($videoService, $externalFilm, $film->id);

            } catch (Throwable $exception) {
                Log::error($exception->__toString());
                continue;
            }

            $bar->advance();
        }

        $bar->finish();
    }

    /**
     * @param ImageService $imageService
     * @param FilmDto      $externalFilm
     * @param int          $filmId
     */
    private function createImages(ImageService $imageService, FilmDto $externalFilm, int $filmId) : void
    {
        foreach ($externalFilm->getImages() as $image) {
            $newImage = $image->toArray();
            $newImage['film_id'] = $filmId;
            $imageService->createImage($newImage);
        }
    }

    /**
     * @param VideoService $videoService
     * @param FilmDto      $externalFilm
     * @param int          $filmId
     */
    private function createVideos(VideoService $videoService, FilmDto $externalFilm, int $filmId) : void
    {
        foreach ($externalFilm->getVideos() as $video) {
            $newVideo = $video->toArray();
            $newVideo['film_id'] = $filmId;
            $videoService->createVideo($newVideo);
        }
    }
}
