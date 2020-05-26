<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TaskControllerTest extends WebTestCase
{
    public function testCreateAndCloseTask(): void
    {
        $client = static::createClient();

        $client->request('GET', '/task-new');
        $client->submitForm('Create Task', [
            'task[title]' => 'My own title',
        ]);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/');

        $count = $crawler
            ->filter('td:contains("My own title")')->count();

        $this->assertEquals(1, $count);

        $client->request('GET', '/close/1');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/');

        $count = $crawler
            ->filter('td:contains("My own title")')->count();

        $this->assertEquals(0, $count);
    }
}
