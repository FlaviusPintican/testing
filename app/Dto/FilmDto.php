<?php declare(strict_types=1);

namespace App\Dto;

use App\ThirdParty\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class FilmDto
{
    /**
     * @var string
     */
    private string $body;

    /**
     * @var array
     */
    private array $cast;

    /**
     * @var string
     */
    private string $cert;

    /**
     * @var string
     */
    private string $class;

    /**
     * @var array
     */
    private array $directors;

    /**
     * @var int
     */
    private int $duration;

    /**
     * @var array
     */
    private array $genres;

    /**
     * @var string
     */
    private string $headline;

    /**
     * @var string
     */
    private string $sourceId;

    /**
     * @var string
     */
    private string $lastUpdated;

    /**
     * @var string
     */
    private string $quote;

    /**
     * @var int
     */
    private int $rating;

    /**
     * @var string
     */
    private string $reviewAuthor;

    /**
     * @var string
     */
    private string $skyGoId;

    /**
     * @var string
     */
    private string $sum;

    /**
     * @var string
     */
    private string $synopsis;

    /**
     * @var int
     */
    private int $year;

    /**
     * @var array
     */
    private array $viewingWindow;

    /**
     * @var array
     */
    private array $videos;

    /**
     * @var array
     */
    private array $images;

    /**
     * @param array $film
     */
    public function __construct(array $film)
    {
        $this->body = $film['body'];
        $this->cast = $film['cast'];
        $this->cert = $film['cert'];
        $this->class = $film['class'];
        $this->directors = $film['directors'];
        $this->duration = $film['duration'];
        $this->genres = $film['genres'] ?? [];
        $this->headline = $film['headline'];
        $this->sourceId = $film['id'];
        $this->lastUpdated = $film['lastUpdated'];
        $this->quote = $film['quote'] ?? '';
        $this->rating = $film['rating'] ?? 0;
        $this->reviewAuthor = $film['reviewAuthor'] ?? '';
        $this->skyGoId = $film['skyGoId'] ?? '';
        $this->sum = $film['sum'];
        $this->synopsis = $film['synopsis'];
        $this->viewingWindow = $film['viewingWindow'] ?? [];
        $this->year = (int) $film['year'];
        $this->videos = $this->setVideos($film['videos'] ?? []);
        $this->images = $this->setImages($film);
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'body' => $this->body,
            'cast' => json_encode($this->cast),
            'cert' => $this->cert,
            'class' => $this->class,
            'directors' => json_encode($this->directors),
            'duration' => $this->duration,
            'genres' => json_encode($this->genres),
            'headline' => $this->headline,
            'source_id' => $this->sourceId,
            'lastUpdated' => $this->lastUpdated,
            'quote' => $this->quote,
            'rating' => $this->rating,
            'reviewAuthor' => $this->reviewAuthor,
            'skyGoId' => $this->skyGoId,
            'sum' => $this->sum,
            'synopsis' => $this->synopsis,
            'viewingWindow' => json_encode($this->viewingWindow),
            'year' => $this->year,
        ];
    }

    /**
     * @return ImageDto[]
     */
    public function getImages() : array
    {
        return $this->images;
    }

    /**
     * @return VideoDto[]
     */
    public function getVideos() : array
    {
        return $this->videos;
    }

    /**
     * @param array $film
     *
     * @return ImageDto[]
     */
    private function setImages(array $film) : array
    {
        $imagesList = [];
        foreach ($film as $key => $filmDetails) {
            if (!in_array($key, ['cardImages', 'cardImages']) ) {
                continue;
            }

            foreach ($filmDetails as $image) {
                $image['type'] = $key;

                if (!$this->isValidResource($image['url'])) {
                    continue;
                }

                $imagesList[] = new ImageDto($image);
            }

        }

        return $imagesList;
    }

    /**
     * @param array $videos
     *
     * @return VideoDto[]
     */
    private function setVideos(array $videos) : array
    {
        $videosList = [];

        foreach ($videos as $video) {
            if (!$this->isValidResource($video['url'])) {
                continue;
            }

            $videosList[] = new VideoDto($video);
        }

        return $videosList;
    }

    /**
     * @param string $url
     *
     * @return bool
     */
    private function isValidResource(string $url) : bool
    {
        if (strlen($url) === 0) {
            return false;
        }

        if (Client::getResponse($url)->status() === Response::HTTP_OK) {
            return true;
        }

        Log::warning("Invalid url: $url");

        return false;
    }
}
