<?php

namespace Services;

/**
 * Class LoadFactory
 * @package Services
 */
class LoadFactory
{
    const DATABASE_TYPE = 'database';

    /**
     * @param string $type
     * @return DatabaseLoadService
     * @throws \Exception
     */
    public function getServiceByType(string $type)
    {
        switch ($type) {
            case self::DATABASE_TYPE:
                $service = new DatabaseLoadService();
                break;
            default:
                throw new \Exception('Unknown type load');
        }

        return $service;
    }
}
