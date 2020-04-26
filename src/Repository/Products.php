<?php

namespace Repository;

use Repository\Database\Database;

/**
 * Class Products
 * @package Repository
 */
class Products extends Database
{
    /**
     * @param int $page
     * @param int $limit
     * @return bool|mixed
     */
    public function getProductsForLoad($page = 1, $limit = 10)
    {
        if (!$this->pdo) {
            return false;
        }

        $sql = '
            select products.id, name
            from products
            where id not in (
                select product_id
                from characteristic
            )
            order by products.id
            limit :limit
            offset :offset
        ';

        $request = $this->pdo->prepare($sql);
        $request->bindValue(':limit', $limit);
        $request->bindValue(':offset', ($page - 1) * $limit);
        $request->execute();
        return $request->fetchAll();
    }

    /**
     * @return bool|mixed
     */
    public function countProductsForLoad()
    {
        if (!$this->pdo) {
            return false;
        }

        $sql = '
            select count(id) as products_count
            from products
            where id not in (
                select product_id
                from characteristic
            )
        ';

        $request = $this->pdo->prepare($sql);
        $request->execute();
        return $request->fetch()['products_count'];
    }
}