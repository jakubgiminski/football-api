<?php declare(strict_types=1);

namespace FootballApi\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetTeamsTest extends WebTestCase
{
    public function testEndpoint(): void
    {
        $client = static::createClient();

        $client->request('GET', '/leagues/premier-league/teams');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
