<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Image;

class ImageRepository
{
    /**
     * @param array $image
     *
     * @return Image
     */
    public function createImage(array $image) : Image
    {
        return Image::create($image);
    }
}
