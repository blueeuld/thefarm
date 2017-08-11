<?php

class ProductApi {

    public function search_products($categories) {
        $search = \TheFarm\Models\ItemQuery::create();

        if ($categories) {
            $search = $search->useItemCategoryQuery()->filterByCategoryId($categories)->endUse();
        }

        $search = $search->filterByIsActive(true);
        $products = $search->find();

        return $products->toArray();
    }

}