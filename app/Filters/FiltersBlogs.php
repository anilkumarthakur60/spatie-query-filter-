<?php


namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FiltersBlogs implements Filter
{
    public function __invoke(Builder $query, $value, string $property): Builder
    {

        dd($value);

        return $query->whereHas('blog', function ($query) use ($value) {
            if (is_array($value)) {
                return $query->whereIn('slug', $value);
            }
            return $query->where('slug', $value);
        });
    }
}
