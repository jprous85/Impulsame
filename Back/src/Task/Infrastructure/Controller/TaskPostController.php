<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Controller;


use Exception;
use Symfony\Component\HttpFoundation\Request;

use Src\Task\Application\Request\TaskCreateRequest;
use Src\Task\Application\UseCases\CreateTask;

final class TaskPostController
{

    public function __construct(private CreateTask $create_task)
    {
    }

    /**
     * @throws Exception
     */
    public function create(Request $request): void
    {
        ($this->create_task)(new TaskCreateRequest(
            $request['name'],
            intval($request['category_id']),
            $request['start_date'],
            $request['finish_date'],
        ));
    }
}
