<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{

    public function filters(Request $request)
    {
        return $request->query();
    }

    public function apply(Builder $builder, Request $request)
    {
        $this->builder = $builder;

        foreach ($this->filters($request) as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

}
