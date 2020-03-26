<?php

namespace Scripter\Service\DB;

/**
 * 
 */
class DBDriver
{   
    /**
     * 
     */
    private $connection;

    /**
     * 
     */
    public function __construct($host, $port, $user, $password, $database)
    {
        $this->connection = new \mysqli($host, $user, $password, $database);
    }

    /**
     * 
     */
    public function execute($query)
    {
        $q = ['select'];
        $q[] = \implode(', ', $query->getColumns());

        $q[] = 'from';
        $q[] = \implode(', ', $query->getFrom());

        $q[] = 'where';
        $q[] = \implode(', ', $query->getWhere());

        $sq = \implode(' ', $q);

        // Binding if needed
        $binds = $query->getBinds();
        if (!empty($binds)) {
            foreach ($binds as $index => $bind) {
                var_dump($index, $bind);
                $sq = \preg_replace($index, $this->connection->mysqli_real_escape_string($bind), $sq);
            }
        }


        var_dump($sq);
        die;
    }
}