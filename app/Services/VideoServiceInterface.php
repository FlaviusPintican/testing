<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Video;

interface VideoServiceInterface
{
    /**
     * @param array $video
     *
     * @return Video
     */
    public function createVideo(array $video) : Video;
}
