<?php

declare(strict_types=1);


namespace Src\Category\Application\Response;



final class CategoryResponses
{
    private array $category_responses;

    public function __construct(CategoryResponse ...$category_responses)
    {
        $this->category_responses = $category_responses;
    }

    public function getCategory(): array
    {
        return $this->category_responses;
    }

    public function toArray(): array
    {
        $category_response_array = [];
        foreach ($this->category_responses as $category_response)
        {
            $category_response_array[] = $category_response->toArray();
        }
        return $category_response_array;
    }
}
