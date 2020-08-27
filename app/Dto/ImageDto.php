<?php declare(strict_types=1);

namespace App\Dto;


class ImageDto
{
    /**
     * @var int
     */
    private int $heigth;

    /**
     * @var int
     */
    private int $width;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $url;

    /**
     * @param array $image
     */
    public function __construct(array $image)
    {
        $this->url = $image['url'];
        $this->heigth = (int) $image['h'];
        $this->width = (int) $image['w'];
        $this->type = $image['type'];
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'url' => $this->url,
            'heigth' => $this->heigth,
            'width' => $this->width,
            'type' => $this->type,
        ];
    }
}
