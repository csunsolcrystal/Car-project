<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Car extends Model
{
    use SearchableTrait;
    protected $table = 'Cars';
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'Model' => 10,
            'Make' => 9,
            'Year' => 8,
            'Trim' => 5,
        ],
      ];
}
