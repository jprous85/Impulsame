<?php

declare(strict_types=1);


namespace Src\Category\Application\UseCases;


use Exception;

use Src\Category\Application\Request\CategoryUpdateRequest;
use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
use Src\Category\Domain\Category;
use Src\Shared\Application\Request\IdRequest;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;

final class UpdateCategory
{

    public function __construct(
        private CategoryRepository $repository,
        private GetCategory        $get_category
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(IdRequest $id_request, CategoryUpdateRequest $request)
    {
        $category = ($this->get_category)($id_request);
        $category = new Category(
            new CategoryIdVo($category->getId()),
            new CategoryNameVo($category->getName()),
            new ActiveVo($category->getActive()),
            new CreatedAtVO($category->getCreatedAt()),
            new UpdatedAtVO($category->getUpdatedAt())
        );

        $category = $this->map($category, $request);

        $this->repository->update($category);
    }

    private function map(Category $category, CategoryUpdateRequest $request): Category
    {
        $name   = $request->getName() ?? $category->getName()->value();
        $active = $request->getActive() ?? $category->getActive()->value();

        $category->update(
            new CategoryNameVo($name),
            new ActiveVo($active)
        );

        return $category;
    }
}
