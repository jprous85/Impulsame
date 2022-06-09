<?php

declare(strict_types=1);


namespace Src\Task\Application\UseCases;


use Exception;
use Src\Shared\Application\Request\IdRequest;
use Src\Task\Application\Response\TaskResponse;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Domain\ValueObjects\TaskIdVo;

final class GetTask
{

    public function __construct(private TaskRepository $repository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(IdRequest $id_request): TaskResponse
    {
        $task = $this->repository->getTask(new TaskIdVo($id_request->getId()));

        if (!$task) {
            throw new Exception('Not exist this task with this ID: ' . $id_request->getId());
        }

        return TaskResponse::SelfTaskResponse($task);
    }
}
