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

        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/');

        $count = $crawler
            ->filter('td:contains("My own title")')->count();

        $this->assertSame(1, $count);

        $client->request('GET', '/close/1');
        $this->assertSame(302, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/');

        $count = $crawler
            ->filter('td:contains("My own title")')->count();

        $this->assertSame(0, $count);
    }
}
