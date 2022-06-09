<?php

declare(strict_types=1);


namespace Src\Shared\Application\Request;


final class IdRequest
{

    public function __construct(private int $value)
    {
    }

    public function getId(): int
    {
        return $this->value;
    }
}
