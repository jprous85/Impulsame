<?php

declare(strict_types=1);


namespace Src\Task\Application\Response;


final class TaskResponses
{
    private array $task_responses;

    public function __construct(TaskResponse ...$task_responses)
    {
        $this->task_responses = $task_responses;
    }

    public function getTask(): array
    {
        return $this->task_responses;
    }

    public function toArray(): array
    {
        $task_response_array = [];
        foreach ($this->task_responses as $task_response)
        {
            $task_response_array[] = $task_response->toArray();
        }
        return $task_response_array;
    }
}
