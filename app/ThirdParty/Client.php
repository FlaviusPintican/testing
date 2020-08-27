<?php declare(strict_types=1);

namespace App\ThirdParty;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Client implements AppClientInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getResponse(string $url) : Response
    {
        return Http::get($url);
    }
}
