<?php

declare(strict_types=1);


namespace Src\Task\Application\UseCases;


use Src\Shared\Application\Request\IdRequest;
use Src\Task\Domain\Repositories\TaskRepository;
use Src\Task\Domain\ValueObjects\TaskIdVo;

final class DeleteTask
{

    public function __construct(private TaskRepository $repository)
    {
    }

    public function __invoke(IdRequest $id_request): void
    {
        $this->repository->delete(new TaskIdVo($id_request->getId()));
    }
}
