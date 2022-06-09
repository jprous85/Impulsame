<?php

declare(strict_types=1);


namespace Src\Task\Application\UseCases;


use Exception;
use Src\Category\Application\UseCases\GetCategory;
use Src\Category\Domain\Category;
use Src\Category\Domain\ValueObjects\CategoryIdVo;
use Src\Category\Domain\ValueObjects\CategoryNameVo;
use Src\Shared\Application\Request\IdRequest;
use Src\Shared\Domain\ValueObjects\ActiveVo;
use Src\Shared\Domain\ValueObjects\CreatedAtVO;
use Src\Shared\Domain\ValueObjects\UpdatedAtVO;
use Src\Task\Application\Request\TaskUpdateRequest;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Domain\Task;
use Src\Task\Domain\ValueObjects\TaskCompleteVo;
use Src\Task\Domain\ValueObjects\TaskFinishDateVo;
use Src\Task\Domain\ValueObjects\TaskIdVo;
use Src\Task\Domain\ValueObjects\TaskNameVo;
use Src\Task\Domain\ValueObjects\TaskStartDateVo;

final class UpdateTask
{
    public function __construct(
        private TaskRepository $repository,
        private GetTask        $get_task,
        private GetCategory    $get_category
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(IdRequest $id_request, TaskUpdateRequest $request): void
    {
        $category = ($this->get_category)(new IdRequest($request->getCategory()));
        $category = new Category(
            new CategoryIdVo($category->getId()),
            new CategoryNameVo($category->getName()),
            new ActiveVo($category->getActive()),
            new CreatedAtVO($category->getCreatedAt()),
            new UpdatedAtVO($category->getUpdatedAt())
        );

        $original_task = ($this->get_task)($id_request);
        $original_task = new Task(
            new TaskIdVo($original_task->getId()),
            new TaskNameVo($original_task->getName()),
            new Category(
                new CategoryIdVo($category->getId()->value()),
                new CategoryNameVo($category->getName()->value()),
                new ActiveVo($category->getActive()->value()),
                new CreatedAtVO($category->getCreatedAt()->value()),
                new UpdatedAtVO($category->getUpdatedAt()->value())
            ),
            new TaskCompleteVo($original_task->getComplete()),
            new TaskStartDateVo($original_task->getStartDate()),
            new TaskFinishDateVo($original_task->getFinishDate()),
            new ActiveVo($original_task->getActive()),
            new CreatedAtVO($original_task->getCreatedAt()),
            new UpdatedAtVO($original_task->getUpdatedAt())
        );

        $task = $this->map($original_task, $request, $category);

        $this->repository->update($task);

    }

    private function map(Task $task, TaskUpdateRequest $request, Category $category): Task
    {

        $name        = $request->getName() ?? $task->getName()->value();
        $complete    = $request->getComplete() ?? $task->getComplete()->value();
        $start_date  = $request->getStartDate() ?? $task->getStartDate()->value();
        $finish_date = $request->getFinishDate() ?? $task->getFinisDate()->value();
        $active      = $request->getActive() ?? $task->getActive()->value();

        $task->update(
            new TaskNameVo($name),
            new Category(
                new CategoryIdVo($category->getId()->value()),
                new CategoryNameVo($category->getName()->value()),
                new ActiveVo($category->getActive()->value()),
                new CreatedAtVO($category->getCreatedAt()->value()),
                new UpdatedAtVO($category->getUpdatedAt()->value())
            ),
            new TaskCompleteVo($complete),
            new TaskStartDateVo($start_date),
            new TaskFinishDateVo($finish_date),
            new ActiveVo($active)
        );

        return $task;
    }
}
