<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Persistence;


use Carbon\Carbon;
use Src\Category\Domain\Category;
use Src\Category\Domain\Repositories\CategoryRepository;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;

final class CategoryMYSQLRepository implements CategoryRepository
{

    public function __construct(private CategoryORMModel $model)
    {
    }

    public function getAllCategories(): array
    {
        $eloquent_query = $this->model->all();

        $categories = [];
        foreach ($eloquent_query as $item) {
            $categories[] = $this->map($item);
        }
        return $categories;
    }

    public function getCategory(CategoryIdVo $id_vo): ?Category
    {
        return $this->map($this->model->find($id_vo->value()));
    }

    public function create(Category $category): void
    {
        $this->model->create($category->getPrimitives());
    }

    public function update(Category $category): void
    {
        $this->model->where('id', $category->getId()->value())->update($category->getPrimitives());
    }

    public function delete(CategoryIdVo $id_vo): void
    {
        $this->model->where('id', $id_vo->value())->delete();
    }

    private function map($request): ? Category
    {

        return $request ? new Category(
            new CategoryIdVo($request->id),
            new CategoryNameVo($request->name),
            new ActiveVo($request->active),
            new CreatedAtVO($request->created_at?->format('Y-m-d h:i')),
            new UpdatedAtVO($request->updated_at?->format('Y-m-d h:i'))
        ) : null;
    }
}
