<?php

declare(strict_types=1);


namespace Src\Category\Application\Request;


final class CategoryUpdateRequest
{

    public function __construct(
        private int $id,
        private string $name,
        private int $active,
        private string $created_at,
        private ?string $updated_at
    )
    {
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
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
