<?php

declare(strict_types=1);

namespace App\FormValue;

use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class TaskFormValue
{
    /**
	 * @var string
     *
     * @Assert\NotBlank
     */
    private $title = '';

    /**
	 * @var string|null
     */
    private $description;

    /**
	 * @var DateTimeInterface|null
     *
     * @Assert\NotBlank
     * @Assert\Type("DateTimeInterface")
     */
    private $assignedDate;

    public function __construct()
    {
        $this->assignedDate = new DateTime();
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

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setAssignedDate(DateTimeInterface $assignedDate): void
    {
        $this->assignedDate = $assignedDate;
    }
}
