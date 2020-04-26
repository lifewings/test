<?php

namespace Repository\Database;

abstract class Database
{
    /** @var \PDO */
    var $pdo;

    /**
     * itemDatabaseStore constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $dsn = 'pgsql:';

        if (isset($params['host']) && $params['host'] !== '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }

        if (isset($params['dbname'])) {
            $dsn .= 'dbname=' . $params['dbname'] . ';';

        } elseif (isset($params['default_dbname'])) {
            $dsn .= 'dbname=' . $params['default_dbname'] . ';';
        } else {
            $dsn .= 'dbname=postgres;';
        }

        $this->pdo = new \PDO($dsn, $params['user'], $params['password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}