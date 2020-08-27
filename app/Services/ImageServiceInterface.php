<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Image;

interface ImageServiceInterface
{
    /**
     * @param array $image
     *
     * @return Image
     */
    public function createImage(array $image) : Image;
}
