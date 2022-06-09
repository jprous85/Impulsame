<?php

declare(strict_types=1);


namespace Src\Category\Application\UseCases;


use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Shared\Application\Request\IdRequest;

final class DeleteCategory
{

    public function __construct(private CategoryRepository $repository)
    {
    }

    public function __invoke(IdRequest $id_request): void
    {
        $this->repository->delete(new CategoryIdVo($id_request->getId()));
    }
}
