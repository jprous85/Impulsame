<?php

declare(strict_types=1);


namespace Src\Category\Application\Request;


final class CategoryCreateRequest
{
    public function __construct(
        private string $name,
        private ?int $active
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
     * @return int|null
     */
    public function getActive(): ?int
    {
        return $this->active;
    }

}
