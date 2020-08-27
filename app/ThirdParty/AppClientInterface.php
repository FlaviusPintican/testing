<?php declare(strict_types=1);

namespace App\ThirdParty;

use Illuminate\Http\Client\Response;

interface AppClientInterface
{
    /**
     * @param string $url
     *
     * @return Response
     */
    public static function getResponse(string $url) : Response;
}
