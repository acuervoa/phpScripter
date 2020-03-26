<?php

namespace Scripter\Driver\DB;

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
    public function _construct($host, $port, $user, $password, $database)
    {
        $this->connection = new \mysqli($host, $user, $password, $database);
    }
}