<?php

namespace Src\Category\Domain\Repositories;

use Src\Category\Domain\Category;
use Src\Category\Domain\ValueObjects\CategoryIdVo;

interface CategoryRepository
{
    public function getAllCategories(): array;

    public function getCategory(CategoryIdVo $id_vo): ?Category;

    public function create(Category $category): void;

    public function update(Category $category): void;

    public function delete(CategoryIdVo $id_vo): void;
}
