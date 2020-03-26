<?php

namespace Scripter\Service\DB;

/**
 * 
 */
class QueryBuilder
{
    /**
     * 
     */
    private $columns;

    /**
     * 
     */
    private $from;

    /**
     * 
     */
    private $join = [];
    
    /**
     * 
     */
    private $where = [];

    /**
     * 
     */
    private $binds = [];

    /**
     * 
     */
    public function __construct()
    {

    }

    /**
     * 
     */
    public function columns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * 
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * 
     */
    public function from(array $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * 
     */
    public function getFrom(): array
    {
        return $this->from;
    }

    /**
     * 
     */
    public function join(string $table, string $clause, string $ns = null): self
    {
        $this->join[] = [$table, $clause, $ns];
        return $this;
    }

    /**
     * 
     */
    public function where(string $where): self
    {
        $this->where[] = $where;
        return $this;
    }

    /**
     * 
     */
    public function getwhere(): array
    {
        return $this->where;
    }

    /**
     * 
     */
    public function binds(array $binds): self
    {
        $this->binds = $binds;
        return $this;
    }

    /**
     * 
     */
    public function getBinds(): array
    {
        return $this->binds;
    }
}