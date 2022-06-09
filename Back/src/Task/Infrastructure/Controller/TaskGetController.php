<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Controller;


use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Src\Task\Application\UseCases\GetAllTasks;
use Src\Task\Application\UseCases\GetTask;
use Src\Shared\Application\Request\IdRequest;

final class TaskGetController
{

    public function __construct(
        private GetTask $get_task,
        private GetAllTasks $get_all_tasks
    )
    {
    }

    public function getAllTasks(): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => ($this->get_all_tasks)(),
                'code' => Response::HTTP_OK
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function getTask(int $id): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => ($this->get_task)(new IdRequest($id)),
                'code' => Response::HTTP_OK
            ]
        );
    }
}
