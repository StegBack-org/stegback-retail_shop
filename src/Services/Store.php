<?php

namespace Stegback\RetailShop\Services;

use Stegback\RetailShop\Models\StoreProduct as ModelsStoreProduct;

class Store
{
    /**
     * @param productID 
     * @param storeID as Store ID
     * @param data as product detail like sku and quantity
     */
    public function assignToStore(int|string $productID, $storeID, $data)
    {
        $product = [
            'user_id' => $storeID,
            'product_id' => $productID,
            'sku' => $data['sku'],
            'quantity' => $data['quantity'],
        ];
        $result = ModelsStoreProduct::updateOrCreate([
            'user_id' => $storeID,
            'product_id' => $productID,
        ], $product);

        return $result;
    }
}
