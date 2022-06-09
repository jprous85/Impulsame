<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Controller;


use Symfony\Component\HttpFoundation\Request;

use Src\Category\Application\Request\CategoryCreateRequest;
use Src\Category\Application\UseCases\CreateCategory;

final class CategoryPostController
{

    public function __construct(private CreateCategory $create_category)
    {
    }

    public function create(Request $request)
    {
        ($this->create_category)(
            new CategoryCreateRequest(
                $request['id'],
                $request['name'],
                intval($request['active']),
                $request['created_at'],
                $request['updated_at'],
            )
        );
    }
}
