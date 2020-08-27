<?php declare(strict_types=1);

namespace App\ThirdParty;

interface ExternalFilmServiceInterface
{
    /**
     * @return array
     */
    public function getFilms() : array;
}
