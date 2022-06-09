<?php

namespace Src\Task\Domain\Repositories;

use Src\Task\Domain\Task;
use Src\Task\Domain\ValueObjects\TaskIdVo;

interface TaskRepository
{
    public function getAllTasks(): array;

    public function getTask(TaskIdVo $id_vo): ?Task;

    public function create(Task $task): void;

    public function update(Task $task): void;

    public function delete(TaskIdVo $id_vo): void;
}
