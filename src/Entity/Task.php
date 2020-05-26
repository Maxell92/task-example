<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     *
     * @var DateTimeInterface
     */
    private $assignedDate;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var bool
     */
    private $isClosed = false;

    public function __construct(string $title, DateTimeInterface $assignedDate, ?string $description)
    {
        $this->title = $title;
        $this->assignedDate = $assignedDate;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAssignedDate(): DateTimeInterface
    {
        return $this->assignedDate;
    }

    public function isOverdue(): bool
    {
        return $this->getAssignedDate() < new DateTime('today');
    }

    public function close(): void
    {
        $this->isClosed = true;
    }

    public function open(): void
    {
        $this->isClosed = false;
    }

    public function isClosed(): bool
    {
        return $this->isClosed;
    }
}
