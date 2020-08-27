<?php declare(strict_types=1);

namespace App\Dto;

class VideoDto
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var array
     */
    private array $alternatives;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $url;

    /**
     * @param array $video
     */
    public function __construct(array $video)
    {
        $this->title = $video['title'];
        $this->alternatives = $video['alternatives'] ?? [];
        $this->type = $video['type'];
        $this->url = $video['url'];
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'url' => $this->url,
            'title' => $this->title,
            'alternatives' => json_encode($this->alternatives),
            'type' => $this->type,
        ];
    }
}
