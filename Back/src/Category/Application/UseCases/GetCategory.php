<?php

declare(strict_types=1);


namespace Src\Category\Application\UseCases;


use Exception;
use Src\Category\Application\Response\CategoryResponse;
use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Shared\Application\Request\IdRequest;

final class GetCategory
{

    public function __construct(private CategoryRepository $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(IdRequest $id_request): CategoryResponse
    {
        $category = $this->repository->getCategory(new CategoryIdVo($id_request->getId()));

        if (!$category) {
            throw new Exception('Not exist Category with this ID: ' . $id_request->getId());
        }

        return CategoryResponse::SelfTaskResponse($category);
    }
}
