<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProjectResourceTest extends ApiTestCase
{
    public function testGetProjects()
    {
        $client = self::createClient();

        $client->request('GET','api/projects');
    }

    public function testGetSpecificProject()
    {
        $client = self::createClient();
    }
}