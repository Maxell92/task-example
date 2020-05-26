<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Task;
use DateTime;
use PHPUnit\Framework\TestCase;

final class TaskTest extends TestCase
{
    public function testProperties(): void
    {
        $title = 'My title';
        $date = (new DateTime('today'))->setTime(23, 59, 59);
        $description = 'My description';

        $task = new Task($title, $date, $description);

        $this->assertSame($title, $task->getTitle());
        $this->assertSame($date, $task->getAssignedDate());
        $this->assertSame($description, $task->getDescription());
        $this->assertFalse($task->isClosed());
        $this->assertFalse($task->isOverdue());
    }

    public function testIsOverdue(): void
    {
        $date = new DateTime('yesterday');

        $task = new Task('title', $date, null);

        $this->assertTrue($task->isOverdue());
    }

    public function testCloseTask(): void
    {
        $date = new DateTime();

        $task = new Task('title', $date, null);

        $this->assertFalse($task->isClosed());

        $task->close();

        $this->assertTrue($task->isClosed());

        $task->open();

        $this->assertFalse($task->isClosed());
    }
}
