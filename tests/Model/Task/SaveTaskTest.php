<?php

declare(strict_types=1);

namespace App\Tests\Model\Task;

use App\Entity\Task;
use App\FormValue\TaskFormValue;
use App\Model\Task\SaveTask;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

final class SaveTaskTest extends TestCase
{
    public function testSave(): void
    {
        $title = 'My title';
        $date = (new DateTime('today'))->setTime(23, 59, 59);
        $description = 'My description';

        $taskFormValue = new TaskFormValue();
        $taskFormValue->setTitle($title);
        $taskFormValue->setAssignedDate($date);
        $taskFormValue->setDescription($description);

        $entityManager = $this->createMock(EntityManagerInterface::class);
        $entityManager->expects($this->once())
            ->method('persist')
            ->with($this->callback(function(Task $task) use ($title) {
                    return $task->getTitle() === $title;
            }));
        $entityManager->expects($this->once())
            ->method('flush')
            ->with();

        $saveTask = new SaveTask($entityManager);

        $saveTask->new($taskFormValue);
    }
}
