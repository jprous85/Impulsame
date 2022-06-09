<?php

declare(strict_types=1);


namespace Src\Task\Application\Request;


use Src\Category\Application\Request\CategoryCreateRequest;

final class TaskCreateRequest
{
    public function __construct(
        private ?int $id,
        private string $name,
        private int $category,
        private ?int $complete,
        private ?string $start_date,
        private ?string $finish_date,
        private ?int $active,
        private ?string $created_at,
        private ?string $updated_at
    )
    {
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }


    /**
     * @return int|null
     */
    public function getComplete(): ?int
    {
        return $this->complete;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->start_date;
    }

    /**
     * @return string|null
     */
    public function getFinishDate(): ?string
    {
        return $this->finish_date;
    }

    /**
     * @return int|null
     */
    public function getActive(): ?int
    {
        return $this->active;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }


}
