<?php

declare(strict_types=1);

namespace App\Tests\Model\Task;

use App\Entity\Task;
use App\Model\Task\CloseTask;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class CloseTaskTest extends TestCase
{
    public function testCloseTask(): void
    {
        $date = new DateTime('yesterday');

        $task = new Task('title', $date, null);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->exactly(2))
            ->method('flush')
            ->with();

        $closeTask = new CloseTask($entityManager);

        $closeTask->close($task);

        $this->assertTrue($task->isClosed());

        $closeTask->open($task);

        $this->assertFalse($task->isClosed());
    }
}
