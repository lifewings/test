<?php

namespace Services\Interfaces;

/**
 * Interface LoadInterface
 * @package Services\Interfaces
 */
interface LoadInterface
{
    public function getProducts(int $page = 1, int $limit = 20);

    public function getCharacteristic(array $product): array;

    public function writeCharacteristic(int $productId, array $characteristic);
}