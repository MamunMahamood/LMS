<?php

namespace App\Filters\Filterable;

use TheJano\LaravelFilterable\Abstracts\FilterableAbstract;
use TheJano\LaravelFilterable\Interfaces\FilterableInterface;

class CourseFilterable extends FilterableAbstract implements FilterableInterface
{
    /**
     * It contains list of Query Filters
     *
     * @var Array
     */
    public array $filters = [
        'published' => 'App\\Filters\\QueryFilter\\PublishedQueryFilter',
    ];
}

