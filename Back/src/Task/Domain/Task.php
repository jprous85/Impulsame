<?php

declare(strict_types=1);


namespace Src\Task\Domain;


use Src\Category\Domain\Category;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;
use Src\Task\Domain\ValueObjects\TaskCompleteVo;
use Src\Task\Domain\ValueObjects\TaskFinishDateVo;
use Src\Task\Domain\ValueObjects\TaskIdVo;
use Src\Task\Domain\ValueObjects\TaskNameVo;
use Src\Task\Domain\ValueObjects\TaskStartDateVo;

final class Task
{
    public function __construct(
        private TaskIdVo         $id,
        private TaskNameVo       $name,
        private Category         $category,
        private TaskCompleteVo   $complete,
        private TaskStartDateVo  $start_date,
        private TaskFinishDateVo $finis_date,
        private ActiveVo         $active,
        private CreatedAtVO      $created_at,
        private UpdatedAtVO      $updated_at
    )
    {
    }

    public static function create(
        TaskNameVo       $name,
        Category         $category,
        TaskCompleteVo   $complete,
        TaskStartDateVo  $start_date,
        TaskFinishDateVo $finis_date,
    ): self
    {
        return new self(
            new TaskIdVo(null),
            $name,
            $category,
            $complete,
            $start_date,
            $finis_date,
            new ActiveVo(1),
            new CreatedAtVO(null),
            new UpdatedAtVO(null)
        );
    }

    public function update(
        TaskNameVo       $name,
        Category         $category,
        TaskCompleteVo   $complete,
        TaskStartDateVo  $start_date,
        TaskFinishDateVo $finis_date,
        ActiveVo         $active
    )
    {
        $this->name       = $name;
        $this->category   = $category;
        $this->complete   = $complete;
        $this->start_date = $start_date;
        $this->finis_date = $finis_date;
        $this->active     = $active;
    }

    /**
     * @return TaskIdVo
     */
    public function getId(): TaskIdVo
    {
        return $this->id;
    }

    /**
     * @return TaskNameVo
     */
    public function getName(): TaskNameVo
    {
        return $this->name;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return TaskCompleteVo
     */
    public function getComplete(): TaskCompleteVo
    {
        return $this->complete;
    }

    /**
     * @return TaskStartDateVo
     */
    public function getStartDate(): TaskStartDateVo
    {
        return $this->start_date;
    }

    /**
     * @return TaskFinishDateVo
     */
    public function getFinisDate(): TaskFinishDateVo
    {
        return $this->finis_date;
    }

    /**
     * @return ActiveVo
     */
    public function getActive(): ActiveVo
    {
        return $this->active;
    }

    /**
     * @return CreatedAtVO
     */
    public function getCreatedAt(): CreatedAtVO
    {
        return $this->created_at;
    }

    /**
     * @return UpdatedAtVO
     */
    public function getUpdatedAt(): UpdatedAtVO
    {
        return $this->updated_at;
    }

    public function getPrimitives(): array
    {
        return [
            'id'         => $this->getId()->value(),
            'name'       => $this->getName()->value(),
            'category'   => $this->getCategory()->getPrimitives(),
            'complete'   => $this->getComplete()->value(),
            'start_date' => $this->getStartDate()->value(),
            'finis_date' => $this->getFinisDate()->value(),
            'active'     => $this->getActive()->value(),
            'created_at' => $this->getCreatedAt()->value(),
            'updated_at' => $this->getUpdatedAt()->value()
        ];
    }
}
