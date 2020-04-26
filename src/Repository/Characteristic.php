<?php

namespace Repository;

use Repository\Database\Database;

/**
 * Class Characteristic
 * @package Repository
 */
class Characteristic extends Database
{
    const F_BRAND = 'brand';
    const F_MODEL = 'model';
    const F_WIDTH = 'width';
    const F_HEIGHT = 'height';
    const F_CONSTRUCTION = 'construction';
    const F_DIAMETER = 'diameter';
    const F_LOAD_INDEX = 'load_index';
    const F_SPEED_INDEX = 'speed_index';
    const F_ABBREVIATIONS = 'abbreviations';
    const F_RANFLAT = 'ranflat';
    const F_CHAMBER = 'chamber';
    const F_SEASON = 'season';

    const FIELD_TYPES = [
        self::F_BRAND => 'string',
        self::F_MODEL => 'string',
        self::F_WIDTH => 'integer',
        self::F_HEIGHT => 'integer',
        self::F_CONSTRUCTION => 'string',
        self::F_DIAMETER => 'integer',
        self::F_LOAD_INDEX => 'string',
        self::F_SPEED_INDEX => 'string',
        self::F_ABBREVIATIONS => 'string',
        self::F_RANFLAT => 'string',
        self::F_CHAMBER => 'string',
        self::F_SEASON => 'string',
    ];

    const REQUIRED_FIELD = [
        self::F_BRAND,
        self::F_MODEL,
        self::F_WIDTH,
        self::F_HEIGHT,
        self::F_CONSTRUCTION,
        self::F_DIAMETER,
        self::F_LOAD_INDEX,
        self::F_SPEED_INDEX,
        self::F_SEASON
    ];

    const MASK_FIELD = [
        self::F_BRAND => 'Nokian|BFGoodrich|Pirelli|Toyo|Continental|Hankook|Mitas',
        '\s+',
        self::F_MODEL => '.*?',
        '\s+',
        self::F_WIDTH => '\d+',
        '/',
        self::F_HEIGHT => '\d+',
        '\s*',
        self::F_CONSTRUCTION => '[a-z]+',
        self::F_DIAMETER => '\d+',
        '\w?\s+',
        self::F_LOAD_INDEX => '[\/\d]+',
        self::F_SPEED_INDEX => '[a-z]+',
        '\s*',
        self::F_ABBREVIATIONS => '(?!TT|TL|TL/TT|RunFlat|Run Flat|ROF|ZP|SSR|ZPS|HRS|RFT)[a-z]+',
        '?\s*',
        self::F_RANFLAT => 'RunFlat|Run Flat|ROF|ZP|SSR|ZPS|HRS|RFT',
        '?\s*.*?\s*',
        self::F_CHAMBER => 'TT|TL|TL/TT',
        '?\s*',
        self::F_SEASON => 'Зимние \(шипованные\)|Внедорожные|Летние|Зимние \(нешипованные\)|Всесезонные'
    ];

    /**
     * @param int $productId
     * @param array $characteristic
     */
    public function writeCharacteristic(int $productId, array $characteristic)
    {
        $sql = 'INSERT INTO characteristic (product_id, brand, model, width, height, construction, diameter, load_index, speed_index, abbreviations, ranflat, chamber, season)'
            . ' VALUES(:product_id, :brand, :model, :width, :height, :construction, :diameter, :load_index, :speed_index, :abbreviations, :ranflat, :chamber, :season)';
        $request = $this->pdo->prepare($sql);

        $request->bindValue(':product_id', $productId);
        $request->bindValue(':brand', $characteristic['brand']);
        $request->bindValue(':model', $characteristic['model']);
        $request->bindValue(':width', $characteristic['width']);
        $request->bindValue(':height', $characteristic['height']);
        $request->bindValue(':construction', $characteristic['construction']);
        $request->bindValue(':diameter', $characteristic['diameter']);
        $request->bindValue(':load_index', $characteristic['load_index']);
        $request->bindValue(':speed_index', $characteristic['speed_index']);
        $request->bindValue(':abbreviations', $characteristic['abbreviations']);
        $request->bindValue(':ranflat', $characteristic['ranflat']);
        $request->bindValue(':chamber', $characteristic['chamber']);
        $request->bindValue(':season', $characteristic['season']);
        $request->execute();
    }
}