<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Video;

class VideoRepository
{
    /**
     * @param array $video
     *
     * @return Video
     */
    public function createVideo(array $video) : Video
    {
        return Video::create($video);
    }
}

