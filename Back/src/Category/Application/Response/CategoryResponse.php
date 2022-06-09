<?php

declare(strict_types=1);


namespace Src\Category\Application\Response;


final class CategoryResponse
{

    public function __construct(
        private int     $id,
        private string  $name,
        private int     $active,
        private string  $created_at,
        private ?string $updated_at,
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

    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'active'     => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public static function SelfTaskResponse($category): self
    {
        return new self(
            $category->getId()->value(),
            $category->getName()->value(),
            $category->getActive()->value(),
            $category->getCreatedAt()->value(),
            $category->getUpdatedAt()->value()
        );
    }

}
