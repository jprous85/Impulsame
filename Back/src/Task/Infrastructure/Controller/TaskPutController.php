<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Controller;


use Exception;
use Symfony\Component\HttpFoundation\Request;

use Src\Task\Application\Request\TaskUpdateRequest;
use Src\Task\Application\UseCases\UpdateTask;
use Src\Shared\Application\Request\IdRequest;


final class TaskPutController
{

    public function __construct(private UpdateTask $update_task)
    {
    }

    /**
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        ($this->update_task)(
            new IdRequest($id),
            new TaskUpdateRequest(
            $request['id'],
            $request['name'],
            $request['category'],
            $request['complete'],
            $request['start_date'],
            $request['finish_date'],
            intval($request['active']),
            $request['created_at'],
            $request['updated_at'],
        ));
    }
}
