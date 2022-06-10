<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Persistence;


use Src\Category\Domain\Category;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
use Src\Category\Infrastructure\Persistence\CategoryMYSQLRepository;
use Src\Category\Infrastructure\Persistence\CategoryORMModel;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Domain\Task;
use Src\Task\Domain\ValueObjects\TaskCompleteVo;
use Src\Task\Domain\ValueObjects\TaskFinishDateVo;
use Src\Task\Domain\ValueObjects\TaskIdVo;
use Src\Task\Domain\ValueObjects\TaskNameVo;
use Src\Task\Domain\ValueObjects\TaskStartDateVo;

final class TaskMYSQLRepository implements TaskRepository
{

    private CategoryMYSQLRepository $caterogy_repository;

    public function __construct(private TaskORMModel $model)
    {
        $this->caterogy_repository = new CategoryMYSQLRepository(new CategoryORMModel());
    }

    public function getAllTasks(): array
    {
        $eloquent_query = $this->model->all();

        $tasks = [];
        foreach ($eloquent_query as $item) {
            $category = $this->caterogy_repository->getCategory(new CategoryIdVo($item->category));
            $tasks[] = $this->map($item, $category);
        }
        return $tasks;
    }

    public function getTask(TaskIdVo $id_vo): ?Task
    {
        $task = $this->model->find($id_vo->value());
        $category = $this->caterogy_repository->getCategory(new CategoryIdVo($task->category));
        return $this->map($task, $category);
    }

    public function create(Task $task): void
    {
        $category_id = $task->getCategory()->getId()->value();
        $task = $task->getPrimitives();

        unset($task['category']);

        $task['category'] = $category_id;

        $this->model->create($task);
    }

    public function update(Task $task): void
    {
        $category_id = $task->getCategory()->getId()->value();
        $task_update = $task->getPrimitives();

        unset($task_update['category']);

        $task_update['category'] = $category_id;

        $this->model->where('id', $task->getId()->value())->update($task_update);
    }

    public function delete(TaskIdVo $id_vo): void
    {
        $this->model->where('id', $id_vo->value())->delete();
    }

    private function map($task, Category $category): ?Task
    {
        return $task ? new Task(
            new TaskIdVo($task->id),
            new TaskNameVo($task->name),
            new Category(
                new CategoryIdVo($category->getId()->value()),
                new CategoryNameVo($category->getName()->value()),
                new ActiveVo($category->getActive()->value()),
                new CreatedAtVO($category->getCreatedAt()->value()),
                new UpdatedAtVO($category->getUpdatedAt()->value())
            ),
            new TaskCompleteVo($task->complete),
            new TaskStartDateVo($task->start_date),
            new TaskFinishDateVo($task->finish_date),
            new ActiveVo($task->active),
            new CreatedAtVO($task->created_at?->format('Y-m-d h:i')),
            new UpdatedAtVO($task->updated_at?->format('Y-m-d h:i'))
        ) : null;
    }
}
