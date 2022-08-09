<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class IntegrationTestCase extends TestCase
{
    public function get(string $url): ResponseInterface
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://php-framework.test',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        return $client->get($url);
    }
}
