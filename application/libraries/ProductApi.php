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

    public function get_product($item_id)
    {
        $product = \TheFarm\Models\ItemQuery::create()->findOneByItemId($item_id);
        $productArr = $product->toArray();
        $productArr['Users'] = $product->getItemsRelatedUsersJoinContact()->toArray();
        $productArr['Facilities'] = $product->getItemsRelatedFacilitiesJoinFacility()->toArray();
        $productArr['Forms'] = $product->getItemFormsJoinForm()->toArray();

        return $productArr;
    }

}