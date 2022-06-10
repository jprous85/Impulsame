<?php

declare(strict_types=1);


namespace Src\Task\Application\Request;


use Src\Category\Application\Request\CategoryCreateRequest;

final class TaskCreateRequest
{
    public function __construct(
        private string  $name,
        private int     $category_id,
        private ?string $start_date,
        private ?string $finish_date,
    )
    {
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
    public function getCategoryId(): int
    {
        return $this->category_id;
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
}
