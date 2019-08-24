<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/24/19
 * Time: 12:08 AM
 */

namespace App\Services;

use App\Services;
use Cassandra;
use Cassandra\Request\Request;

class CassandraService
{
    private $connection;

    /**
     * CassandraService constructor.
     */
    public function __construct()
    {
        $conf = Services::configService()->getConfig()['database'];
        $nodes = [$conf['addr']];
        $this->connection = new Cassandra\Connection($nodes, $conf['keySpace']);
        try {
            $this->connection->connect();
        } catch (Cassandra\Exception $e) {
            throw $e;
            exit;//if connect failed it may be good idea not to continue
        }
        $this->connection->setConsistency(Request::CONSISTENCY_QUORUM);
    }


    public function query(string $query, array $var)
    {
        $response = $this->connection->querySync($query, $var);

        return $response->fetchAll();

    }

    public function selectAll(string $table)
    {

        $selectQuery = $this->query("SELECT id FROM $table ORDER BY id DESC", []);

        return $selectQuery;

    }

    public function select(string $table, array $primaryKeys): array
    {

        if (!empty($primaryKeys)) {
            $values = [];
            foreach ($primaryKeys as $item) {
                $values[] = $item;
            }

            $selectResult = $this->query(
                sprintf(
                    "SELECT * FROM $table WHERE id IN (%s)",
                    implode(",", array_fill(0, count($primaryKeys), "?"))
                ),
                $values
            );
            foreach ($selectResult as $value) {
                $results[$value['id']] = $value;
            }
        }

        return $results;
    }

    public function insert(string $table, array $columns, array $values): void
    {
        $valuesSqlString = [];
        $sqlValues = [];
        foreach ($values as $value) {
            $valuesSqlString[] = "(" . implode(',', array_fill(0, count($value), "?")) . ")";
            $sqlValues = array_merge($sqlValues, $value);
        }

        $query = sprintf(
            "INSERT INTO $table (%s) VALUES %s",
            implode(",", $columns),
            implode(",", $valuesSqlString)
        );


        $this->query($query, $sqlValues);
    }

    public function update(string $table, array $columns, array $values): void
    {

        $columnSql = [];
        foreach ($columns as $column) {
            $columnSql[] = $column . " = ? ";
        }
        $columnSql = implode(" , ", $columnSql);

        $this->query("UPDATE $table SET $columnSql WHERE id = ?", $values);

    }

    public function delete(string $table, array $primaryKeys): void
    {
        $keysSql = implode(",", array_fill(0, count($primaryKeys), "?"));

        $this->query("DELETE from $table WHERE id IN ($keysSql);", $primaryKeys);
    }

}