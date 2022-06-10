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
use Src\Task\Application\Request\TaskCreateRequest;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Domain\Task;
use Src\Task\Domain\ValueObjects\TaskCompleteVo;
use Src\Task\Domain\ValueObjects\TaskFinishDateVo;
use Src\Task\Domain\ValueObjects\TaskNameVo;
use Src\Task\Domain\ValueObjects\TaskStartDateVo;

final class CreateTask
{

    public function __construct(
        private TaskRepository $repository,
        private GetCategory    $get_category
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(TaskCreateRequest $request): void
    {
        $category = ($this->get_category)(new IdRequest($request->getCategoryId()));

        $task = Task::create(
            new TaskNameVo($request->getName()),
            new Category(
                new CategoryIdVo($category->getId()),
                new CategoryNameVo($category->getName()),
                new ActiveVo($category->getActive()),
                new CreatedAtVO($category->getCreatedAt()),
                new UpdatedAtVO($category->getUpdatedAt())
            ),
            new TaskStartDateVo($request->getStartDate()),
            new TaskFinishDateVo($request->getFinishDate())
        );

        $this->repository->create($task);
    }
}
