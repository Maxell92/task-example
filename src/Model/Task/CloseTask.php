<?php

declare(strict_types=1);

namespace App\Model\Task;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

final class CloseTask
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function close(Task $task): void
    {
        $task->close();

        $this->entityManager->flush();
    }

    public function open(Task $task): void
    {
        $task->open();

        $this->entityManager->flush();
    }
}
