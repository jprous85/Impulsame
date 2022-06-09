<?php

declare(strict_types=1);


namespace Src\Task\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Category\Infrastructure\Persistence\CategoryORMModel;

final class TaskORMModel extends Model
{

    protected $table = 'tasks';

    protected $guarded = [];


    public function category(): HasOne
    {
        return $this->hasOne(CategoryORMModel::class);
    }
}
