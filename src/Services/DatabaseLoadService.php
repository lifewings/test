<?php

namespace Services;

use Repository\Characteristic;
use Repository\Products;
use Services\Interfaces\LoadInterface;

class DatabaseLoadService implements LoadInterface
{
    const REGEX_VALUE = '(%s)';
    const REGEX_STR = '~%s~iu';

    /**
     * @param int $page
     * @param int $limit
     * @return bool|mixed
     */
    public function getProducts(int $page = 1, int $limit = 10)
    {
        $productsRepository = new Products(CONFIG_DATABASE);
        return $productsRepository->getProductsForLoad($page, $limit);
    }

    /**
     * @param array $product
     * @return array
     */
    public function getCharacteristic(array $product): array
    {
        $data = [];
        list($regex, $regexArray) = $this->getFormatCharacteristic();

        if (preg_match($regex, $product['name'], $matches)) {
            foreach ($regexArray as $key => $value) {
                if (isset($matches[$key])) {
                    $data[$value] = $matches[$key];
                }
            }
        }

        return $data;
    }

    /**
     * @param int $productId
     * @param array $characteristic
     */
    public function writeCharacteristic(int $productId, array $characteristic)
    {
        $characteristicRepository = new Characteristic(CONFIG_DATABASE);
        $characteristicRepository->writeCharacteristic($productId, $characteristic);
    }

    /**
     * @return array
     */
    private function getFormatCharacteristic(): array
    {
        $regex = '';
        $regexIndex = 1;
        $regexArray = [];
        foreach (Characteristic::MASK_FIELD as $key => $value) {
            if (is_numeric($key)) {
                $regex .= $value;
            } else {
                $regexArray[$regexIndex++] = $key;
                $regex .= sprintf(self::REGEX_VALUE, $value);
            }
        }

        $regex = sprintf(self::REGEX_STR, $regex);

        return [$regex, $regexArray];
    }
}