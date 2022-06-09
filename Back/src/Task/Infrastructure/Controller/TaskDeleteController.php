<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Controller;


use Src\Task\Application\UseCases\DeleteTask;
use Src\Shared\Application\Request\IdRequest;

final class TaskDeleteController
{

    public function __construct(private DeleteTask $delete_task)
    {
    }

    public function delete(int $id): void
    {
        ($this->delete_task)(new IdRequest($id));
    }
}
