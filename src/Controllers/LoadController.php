<?php

namespace Controllers;

use Services\LoadService;

/**
 * Class LoadController
 * @package Controllers
 */
class LoadController
{
    /**
     * @return array
     * @throws \Exception
     */
    public function loadData()
    {
        $loadService = new LoadService();
        $result = $loadService->loadCharacteristic();

        return json_encode($result);
    }
}