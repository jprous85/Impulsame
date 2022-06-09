<?php

declare(strict_types=1);


namespace Src\Category\Domain;


use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;

final class Category
{
    public function __construct(
        private CategoryIdVo   $id,
        private CategoryNameVo $name,
        private ActiveVo       $active,
        private CreatedAtVO    $created_at,
        private UpdatedAtVO    $updated_at
    )
    {
    }


    public static function create(
        CategoryNameVo $name,
    ): self
    {
        return new self(
            new CategoryIdVo(null),
            $name,
            new ActiveVo(1),
            new CreatedAtVO(null),
            new UpdatedAtVO(null)
        );
    }

    public function update(
        CategoryNameVo $name,
        ActiveVo       $active
    )
    {
        $this->name   = $name;
        $this->active = $active;
    }


    /**
     * @return CategoryIdVo
     */
    public function getId(): CategoryIdVo
    {
        return $this->id;
    }

    /**
     * @return CategoryNameVo
     */
    public function getName(): CategoryNameVo
    {
        return $this->name;
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
            'active'     => $this->getActive()->value(),
            'created_at' => $this->getCreatedAt()->value(),
            'updated_at' => $this->getUpdatedAt()->value()
        ];
    }
}
