<?php

declare(strict_types=1);


namespace Src\Task\Application\UseCases;


use Src\Task\Application\Response\TaskResponse;
use Src\Task\Application\Response\TaskResponses;
use Src\Task\Domain\Repositories\TaskRepository;

final class GetAllTasks
{

    public function __construct(private TaskRepository $repository)
    {
    }

    public function __invoke(): TaskResponses
    {
        return new TaskResponses(...$this->map($this->repository->getAllTasks()));
    }

    private function map($tasks): array
    {
        $tasks_array = [];
        foreach ($tasks as $task) {
            $tasks_array[] = TaskResponse::SelfTaskResponse($task);
        }
        return $tasks_array;
    }
}
