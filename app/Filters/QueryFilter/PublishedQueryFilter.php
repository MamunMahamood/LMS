<?php

namespace App\Filters\QueryFilter;

use Illuminate\Database\Eloquent\Builder;
use TheJano\LaravelFilterable\Abstracts\QueryFilterAbstract;
use TheJano\LaravelFilterable\Interfaces\QueryFilterInterface;

class PublishedQueryFilter extends QueryFilterAbstract implements QueryFilterInterface
{
    /**
     * Can be used to map the values.
     * It can be returned through resolveValue method
     *
     * @var Array
    */
    protected array $mapValues = [
        'true' => true,
        'false' => false,
    ];

    /**
     * Handle The Query Filter
     *
     *
     * @param Builder $builder Query Builder
     * @param string $value
     * @return Builder
    **/
    public function handle(Builder $builder, $value): Builder
    {

        $value = $this->resolveValue($value);
        if (is_null($value)) {
            return $builder;
        }

        return $builder->where('published', $value);
    }
}

