<?php


class Database
{
    const HOST = 'mysqlstudenti.litv.sssvt.cz';
    const DBNAME = '4b2_zubarevaruslana_db1';
    const USER = 'zubarevaruslana';
    const PASSWORD = '123456Ab';

    private $conn;

    public function __construct()
    {
        $this->conn = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DBNAME,
            self::USER,
            self::PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        $this->conn->query('SET NAMES utf8');
    }

    public function select($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetchAll();
    }

    public function selectSingle($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->fetch();
    }

    public function insert($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $this->conn->lastInsertId();
    }

    public function update($sql, $params = [])
    {
        $stmt = $this->execute($sql, $params);
        return $stmt->rowCount();
    }

    public function delete($sql, $params = [])
    {
        return $this->update($sql, $params);
    }

    private function execute($sql, $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

}