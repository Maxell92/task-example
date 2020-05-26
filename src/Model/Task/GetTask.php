<?php

declare(strict_types=1);

namespace App\Model\Task;

use App\Entity\Task;
use App\Repository\TaskRepository;

final class GetTask
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return Task[]
     */
    public function getTasks(bool $today): array
    {
        return $this->taskRepository->getTasks($today);
    }

    /**
     * @return Task[]
     */
    public function getClosedTasks(): array
    {
        return $this->taskRepository->getClosedTasks();
    }
}
