<?php

declare(strict_types=1);


namespace Src\Category\Application\UseCases;


use Src\Category\Application\Response\CategoryResponse;
use Src\Category\Application\Response\CategoryResponses;
use Src\Category\Domain\Repositories\CategoryRepository;

final class GetAllCategories
{

    public function __construct(private CategoryRepository $repository)
    {
    }

    public function __invoke(): CategoryResponses
    {
        return new CategoryResponses(...$this->map($this->repository->getAllCategories()));
    }

    private function map($categories): array
    {
        $categories_array = [];
        foreach ($categories as $category) {
            $categories_array[] = CategoryResponse::SelfTaskResponse($category);
        }
        return $categories_array;
    }
}
