<?php

declare(strict_types=1);

namespace App\Model\Task;

use App\Entity\Task;
use App\FormValue\TaskFormValue;
use Doctrine\ORM\EntityManagerInterface;

final class SaveTask
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function new(TaskFormValue $taskFormValue): void
    {
        $task = new Task($taskFormValue->getTitle(), $taskFormValue->getAssignedDate(), $taskFormValue->getDescription());

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
