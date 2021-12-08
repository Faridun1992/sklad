<?php

namespace App\Filters;

class ProductFilter extends QueryFilter
{
    public function category_id($id = null)
    {
        return $this->builder->when($id, fn($query) => $query->where('category_id', $id));
    }
    public function storage_id($id = null)
    {
        return $this->builder->when($id, fn($query) => $query->where('storage_id', $id));
    }

    public function search_field_title($search_string = '')
    {
        return $this->builder
            ->where('title', 'LIKE', '%'.$search_string.'%');
    }

    public function search_field_vendor($search_string = '')
    {
        return $this->builder
            ->where('vendor_code', 'LIKE', '%'.$search_string.'%');
    }

    public function search_field_code($search_string = '')
    {
        return $this->builder
            ->where('code', 'LIKE', '%'.$search_string.'%');
    }
}
