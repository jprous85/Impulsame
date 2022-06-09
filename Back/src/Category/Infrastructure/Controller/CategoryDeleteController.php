<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Controller;


use Src\Category\Application\UseCases\DeleteCategory;
use Src\Shared\Application\Request\IdRequest;

final class CategoryDeleteController
{

    public function __construct(private DeleteCategory $delete_category)
    {
    }

    public function delete(int $id): void
    {
        ($this->delete_category)(new IdRequest($id));
    }
}
