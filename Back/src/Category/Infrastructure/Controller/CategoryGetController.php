<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Controller;


use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Src\Category\Application\UseCases\GetAllCategories;
use Src\Category\Application\UseCases\GetCategory;
use Src\Shared\Application\Request\IdRequest;

final class CategoryGetController
{

    public function __construct(
        private GetCategory $get_category,
        private GetAllCategories $get_all_categories
    )
    {
    }

    public function getAllCategories(): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => ($this->get_all_categories)()->toArray(),
                'code' => Response::HTTP_OK
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function getCategory(int $id): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => ($this->get_category)(new IdRequest($id))->toArray(),
                'code' => Response::HTTP_OK
            ]
        );
    }
}
