<?php

declare(strict_types=1);


namespace Src\Category\Infrastructure\Persistence;


use Illuminate\Database\Eloquent\Model;

final class CategoryORMModel extends Model
{

    protected $table = 'categories';

    protected $guarded = [];

}
