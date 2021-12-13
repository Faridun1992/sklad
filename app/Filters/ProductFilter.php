<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ProductFilter extends QueryFilter
{
    public function category_id($id = null)
    {
        return $this->builder->when($id, fn($query) => $query->where('category_id', $id));
    }

    public function storage_id($id = null)
    {
        return $this->builder->when($id, fn($query) => $query->with(['storages' => fn($q) => $q->where('storage_id', $id)]));
    }

    public function search_field_title($search_string = '')
    {
        return $this->builder
            ->where('title', 'LIKE', '%' . $search_string . '%');
    }

    public function search_field_vendor($search_string = '')
    {
        return $this->builder
            ->where('vendor_code', 'LIKE', '%' . $search_string . '%');
    }

    public function search_field_code($search_string = '')
    {
        return $this->builder
            ->where('code', 'LIKE', '%' . $search_string . '%');
    }

    /*public function search_field_title_or_code($search_string = '', Request $request)
    {
        return $this->builder
            ->when($request->has('storage_id'), fn($query) => $query->with(['storages' => fn($q) => $q->where('storage_id', $request->storage_id)]))
            ->where('code', 'LIKE', '%' . $search_string . '%')
            ->orWhere('title', 'LIKE', '%' . $search_string . '%');
    }*/
}
