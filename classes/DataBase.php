<?php
/**
 * Class DataBase
 */
class DataBase
{
    private $link;

    public function  __construct($host, $user, $password, $db)
    {
        $this->link = mysqli_connect($host, $user, $password, $db);
    }

    public function lastError()
    {
        return mysqli_error($this->link);
    }

    public function isConnected()
    {
        return $this->link != false;
    }

    public function getData($sql, $sql_data = [])
    {

        $result = [];

        $stmt = $this->dbGetPrepareStmt($this ->link, $sql, $sql_data);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        if (empty($res)) {
            return [];
        } else {
            while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                $result [] = $row;
            }
            return $result;
        }
    }

    public function putData($sql, $sql_data = [])
    {

        $stmt = $this -> dbGetPrepareStmt($this -> link, $sql, $sql_data);
        mysqli_stmt_execute($stmt);

        $result = mysqli_insert_id($link);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    public function updateData($table, $sql_data = [], $where = [])
    {

        $placeholders = [];

        foreach ($sql_data as $key => $value) {
            $placeholders []= "`{$key}` = ?";
        }

        $placeholders = implode(', ', $placeholders);
        $key_where = key($where);
        $sql = "UPDATE `{$table}` SET " . $placeholders . " WHERE {$key_where} = ?";
        $data = array_merge($sql_data, $where);
        $stmt = $this->dbGetPrepareStmt($this -> link, $sql, $data);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_affected_rows($link);

        if (!$result) {
            return false;
        } else {
            return $result;
        }
    }

    private function dbGetPrepareStmt($sql, $data = [])
    {
        $stmt = mysqli_prepare($this->link , $sql);

        if ($data) {
            $types = '';
            $stmt_data = [];

            foreach ($data as $value) {
                $type = null;

                if (is_int($value)) {
                    $type = 'd';
                }
                else if (is_string($value)) {
                    $type = 's';
                }
                else if (is_double($value)) {
                    $type = 'd';
                }

                if ($type) {
                    $types .= $type;
                    $stmt_data[] = $value;
                }
            }

            $values = array_merge([$stmt, $types], $stmt_data);

            $func = 'mysqli_stmt_bind_param';
            $func(...$values);
        }

        return $stmt;
    }

}