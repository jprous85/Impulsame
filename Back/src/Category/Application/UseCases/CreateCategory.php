<?php

declare(strict_types=1);


namespace Src\Category\Application\UseCases;


use Src\Category\Application\Request\CategoryCreateRequest;
use Src\Category\Domain\Category;
use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Domain\ValueObjects\CategoryNameVo;

final class CreateCategory
{

    public function __construct(private CategoryRepository $repository)
    {
    }

    public function __invoke(CategoryCreateRequest $request): void
    {
        $category = Category::create(
            new CategoryNameVo($request->getName())
        );

        $this->repository->create($category);
    }
}
