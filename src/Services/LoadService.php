<?php

namespace Services;

use Repository\Characteristic;
use Repository\Products;

/**
 * Class LoadService
 * @package Services
 */
class LoadService
{
    /**
     * @return array
     * @throws \Exception
     */
    public function loadCharacteristic()
    {
        $productWrite = [];
        $productError = [];
        $productsRepository = new Products(CONFIG_DATABASE);
        $count = $productsRepository->countProductsForLoad();

        if (!empty($count)) {
            $service = (new LoadFactory())->getServiceByType(CONFIG_LOAD['load_type']);
            $page = 1;
            do {
                $products = $service->getProducts($page);
                foreach ($products as $product) {
                    $characteristic = $service->getCharacteristic($product);

                    if ($this->isValidCharacteristic($characteristic)) {
                        $productWrite[] = $product['name'];
                        $service->writeCharacteristic($product['id'], $characteristic);
                    } else {
                        $productError[] = $product['name'];
                    }
                }
                $page++;
            } while(count($products) > 0);
        } else {
            return ['result' => 'Нет товаров для характеристик'];
        }

        return ['result' => 'Выполнено создание характеристик', 'productWrite' => $productWrite, 'productError' => $productError];
    }

    /**
     * @param $characteristic
     * @return bool
     */
    private function isValidCharacteristic($characteristic)
    {
        foreach (Characteristic::REQUIRED_FIELD as $field) {
            if (empty($characteristic[$field])) {
                return false;
            }
        }

        return true;
    }
}