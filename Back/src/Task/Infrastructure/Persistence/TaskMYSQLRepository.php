<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Persistence;


use Src\Category\Domain\Category;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
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

    public function __construct(private TaskORMModel $model)
    {
    }

    public function getAllTasks(): array
    {
        $eloquent_query = $this->model->all();

        $tasks = [];
        foreach ($eloquent_query as $item) {
            $tasks[] = $this->map($item);
        }
        return $tasks;
    }

    public function getTask(TaskIdVo $id_vo): ?Task
    {
        return $this->map($this->model->find($id_vo->value()));
    }

    public function create(Task $task): void
    {
        $this->model->create($task->getPrimitives());
    }

    public function update(Task $task): void
    {
        $this->model->where('id', $task->getId()->value())->update($task->getPrimitives());
    }

    public function delete(TaskIdVo $id_vo): void
    {
        $this->model->where('id', $id_vo->value())->delete();
    }

    private function map($request): ?Task
    {
        return $request ? new Task(
            new TaskIdVo($request->id),
            new TaskNameVo($request->name),
            new Category(
                new CategoryIdVo($request->category->id),
                new CategoryNameVo($request->category->name),
                new ActiveVo($request->category->active),
                new CreatedAtVO($request->category->created_at),
                new UpdatedAtVO($request->category->updated_at)
            ),
            new TaskCompleteVo($request->complete),
            new TaskStartDateVo($request->start_date),
            new TaskFinishDateVo($request->finish_date),
            new ActiveVo($request->active),
            new CreatedAtVO($request->created_at),
            new UpdatedAtVO($request->updated_at)
        ) : null;
    }
}
