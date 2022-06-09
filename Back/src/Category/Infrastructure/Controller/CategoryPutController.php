<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Controller;


use Symfony\Component\HttpFoundation\Request;

use Src\Category\Application\Request\CategoryUpdateRequest;
use Src\Category\Application\UseCases\UpdateCategory;
use Src\Shared\Application\Request\IdRequest;

final class CategoryPutController
{

    public function __construct(private UpdateCategory $update_category)
    {
    }

    /**
     * @throws \Exception
     */
    public function update(int $id, Request $request)
    {
        ($this->update_category)(
            new IdRequest($id),
            new CategoryUpdateRequest(
            $request['id'],
            $request['name'],
            intval($request['active']),
            $request['created_at'],
            $request['updated_at'],
        ));
    }
}
