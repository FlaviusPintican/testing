<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Repository\ImageRepository;

class ImageService implements ImageServiceInterface
{
    /**
     * @var ImageRepository
     */
    private ImageRepository $imageRepository;

    /**
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function createImage(array $image) : Image
    {
        return $this->imageRepository->createImage($image);
    }
}
