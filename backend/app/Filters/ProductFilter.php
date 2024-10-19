<?php

namespace App\Filters;

class ProductFilter extends Filter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $searchRelations = [
        'category' => ['id', 'name']
    ];

    /**
     * Searchable columns of the table
     *
     * @var array
     */
    public $searchColumns = ['id', 'name', 'price', 'quantity'];

    /**
     * Category filter
     */
    public function categories($ids): ProductFilter
    {
        info($ids);
        $ids = explode(',', $ids);
        return $this->whereIn('category_id', $ids);
    }
}
