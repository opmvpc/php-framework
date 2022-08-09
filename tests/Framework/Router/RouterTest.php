<?php

namespace Tests\Framework\Router;

use Tests\IntegrationTestCase;

use function PHPUnit\Framework\assertEquals;

/**
 * RouterTest
 * @group router
 * @covers Router
 */
class RouterTest extends IntegrationTestCase
{
    public function testRootUrlDispatch()
    {
        $response = $this->get('/');
        assertEquals(200, $response->getStatusCode());
        assertEquals("<h1>Hello</h1>", $response->getBody()->getContents());
    }
}
