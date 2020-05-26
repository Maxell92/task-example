<?php

namespace App\Repository;

use App\Entity\Task;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

final class TaskRepository
{
    /**
     * @var EntityRepository
     */
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityRepository = $entityManager->getRepository(Task::class);
    }

    /**
     * @return Task[]
     */
    public function getTasks(bool $today): array
    {
        $queryBuilder = $this->getBaseQueryBuilder()
            ->andWhere('task.isClosed = FALSE');

        if ($today) {
            $date = (new DateTime())->setTime(23, 59, 59);
            $queryBuilder->andWhere('task.assignedDate <= :date')
                ->setParameter('date', $date);
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Task[]
     */
    public function getClosedTasks(): array
    {
        $queryBuilder = $this->getBaseQueryBuilder()
            ->andWhere('task.isClosed = TRUE');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    private function getBaseQueryBuilder(): QueryBuilder
    {
        return $this->entityRepository->createQueryBuilder('task')
            ->orderBy('task.assignedDate', 'ASC');
    }
}
