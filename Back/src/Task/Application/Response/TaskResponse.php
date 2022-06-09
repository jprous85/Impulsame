<?php

declare(strict_types=1);


namespace Src\Task\Application\Response;


final class TaskResponse
{

    public function __construct(
        private int     $id,
        private string  $name,
        private array   $category,
        private int     $complete,
        private ?string $start_date,
        private ?string $finish_date,
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
     * @return array
     */
    public function getCategory(): array
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getComplete(): int
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
            'id'          => $this->id,
            'name'        => $this->name,
            'category'    => $this->category,
            'start_date'  => $this->start_date,
            'finish_date' => $this->finish_date,
            'active'      => $this->active,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at
        ];
    }

    public static function SelfTaskResponse($task): self
    {
        return new self(
            $task->getId()->value(),
            $task->getName()->value(),
            $task->getCategory()->getPrimitives(),
            $task->getStartDate()->value(),
            $task->getFinisDate()->value(),
            $task->getActive()->value(),
            $task->getCreatedAt()->value(),
            $task->getUpdatedAt()->value()
        );
    }
}
