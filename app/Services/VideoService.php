<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Video;
use App\Repository\VideoRepository;

class VideoService implements VideoServiceInterface
{
    /**
     * @var VideoRepository
     */
    private VideoRepository $videoRepository;

    /**
     * @param VideoRepository $videoRepository
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function createVideo(array $video) : Video
    {
        return $this->videoRepository->createVideo($video);
    }
}
