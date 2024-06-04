<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class PaginationHelper {
    public static function paginate(Collection $collection, $per_page = 10) {
        $page_number = Paginator::resolveCurrentPage('page');

        $total_page_number = $collection->count();

        $collection = $collection->forPage($page_number, $per_page);

        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ];

        $paginated_data = self::paginator(
            $collection,
            $total_page_number,
            $per_page,
            $page_number,
            $options
        );

        return $paginated_data;

    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $total
     * @param  int  $per_page
     * @param  int  current_page
     * @param  array  $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
     public static function paginator($items, $total, $perPage, $currentPage, $options) {
        $params = compact('items','total','perPage', 'currentPage', 'options');
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, $params);
     }

}
