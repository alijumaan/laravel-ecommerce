<?php

namespace App\Traits;

trait FilterTrait
{
    public function filter($query)
    {
        $keyword = (isset(\request()->keyword) && \request()->keyword != '') ? \request()->keyword : null;
        $status = (isset(\request()->status) && \request()->status != '') ? \request()->status : null;
        $sortBy = (isset(\request()->sort_by) && \request()->sort_by != '') ? \request()->sort_by : 'id';
        $orderBy = (isset(\request()->order_by) && \request()->order_by != '') ? \request()->order_by : 'desc';
        $limitBy = (isset(\request()->limit_by) && \request()->limit_by != '') ? \request()->limit_by : '10';
        $productId = (isset(\request()->product_id) && \request()->product_id != '') ? \request()->product_id : null;
        $categoryId = (isset(\request()->category_id) && \request()->category_id != '') ? \request()->category_id : null;
        $tagId = (isset(\request()->tag_id) && \request()->tag_id != '') ? \request()->tag_id : null;

        $var = $query;
        if ($keyword != null) {
            $var = $var->search($keyword);
        }
        if ($status != null) {
            $var = $var->whereStatus($status);
        }
        if ($categoryId != null) {
            $var = $var->whereCategoryId($categoryId);
        }
        if ($tagId != null) {
            $var = $var->whereHas('tags', function ($query) use ($tagId) {
                $query->where('id', $tagId);
            });
        }
        if ($productId != null) {
            $var = $var->whereProductId($productId);
        }

        $var = $var->orderBy($sortBy, $orderBy);
        $var = $var->paginate($limitBy);

        return $var;
    }

}
