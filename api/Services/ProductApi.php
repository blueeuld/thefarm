<?php

namespace TheFarm\Services;

use TheFarm\Models\ItemQuery;

class ProductApi {

    public function searchProducts($categoryId) {
        $search = ItemQuery::create();

        if ($categoryId) {
            $search = $search->useItemCategoryQuery()
                ->filterByCategoryId($categoryId)
                ->endUse();
        }

        return $search->find();
    }
}