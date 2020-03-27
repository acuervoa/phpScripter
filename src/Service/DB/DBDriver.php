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
        // Columns
        $q = ['select'];
        $q[] = \implode(', ', $query->getColumns());

        // From
        $q[] = 'from';
        $q[] = "{$query->getFrom()[0]} {$query->getFrom()[1]}";

        // Joins
        $joins = $query->getJoin();
        if (!empty($joins)) {
            $j = [];
            foreach ($joins as $join) {
                $j[] = \sprintf(
                    "join %s %s on (%s)",
                    $join[0],
                    $join[2],
                    $join[1]
                );
            }
            $q[] = \implode(' ', $j);
        }

        // Where
        $where = $query->getWhere();
        if (!empty($where)) {
            $q[] = 'where';
            $q[] = \implode(', ', $where);
        }

        // Query Array to String
        $sq = \implode(' ', $q);

        // Binding if needed
        $binds = $query->getBinds();
        if (!empty($binds)) {
            foreach ($binds as $index => $bind) {
                $sq = \preg_replace("/{$index}/", '\'' . $this->connection->real_escape_string($bind) . '\'', $sq);
            }
        }

        // Execute
        $result = $this->connection->query($sq);

        if ($this->connection->error) {
            // @todo do this better
            var_dump($this->connection->error);
            die;
        }

        // Process
        return $this->processMysqlResult($query, $result);
    }

    /**
     * 
     */
    public function replaceOneRaw(string $table, array $data)
    {
        //
        $q = "replace into %s (%s) values ('%s')";

        $columns = \array_keys($data);
        $values = \array_values($data);

        // Avoid SQL injection
        \array_walk($values, function(&$element) {
            $element = $this->connection->real_escape_string($element);
        });

        //
        $sq = \sprintf(
            $q,
            $table,
            \implode(', ', $columns),
            \implode('\', \'', $values)
        );

        //
        $this->connection->query($sq);
    }

    /**
     * 
     */
    private function processMysqlResult($query, \mysqli_result $result)
    {
        $return = [];
        $keys = \array_keys($query->getColumns());

        while ($row = $result->fetch_row()) {
            $buffer = [];
            foreach($row as $index => $column) {
                $buffer[$keys[$index]] = $column;
            }
            $return[] = $buffer;
        }
        $result->close();

        return $return;
    }
}