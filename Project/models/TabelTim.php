<?php
require_once("DB.php");

class TabelTim extends DB {
    
    // Constructor menerima object $db (dari index.php)
    public function __construct($db) {
        parent::__construct($db->host, $db->db_name, $db->username, $db->password);
    }

    public function getAllTim() {
        $this->executeQuery("SELECT * FROM tim ORDER BY nama_tim ASC");
        return $this->getAllResult();
    }

    public function getTimById($id) {
        $this->executeQuery("SELECT * FROM tim WHERE id = :id", ['id' => $id]);
        $res = $this->getAllResult();
        return $res[0] ?? null;
    }

    public function addTim($nama, $mesin, $sasis) {
        $sql = "INSERT INTO tim (nama_tim, mesin, sasis) VALUES (:n, :m, :s)";
        $this->executeQuery($sql, ['n' => $nama, 'm' => $mesin, 's' => $sasis]);
    }

    public function updateTim($id, $nama, $mesin, $sasis) {
        $sql = "UPDATE tim SET nama_tim=:n, mesin=:m, sasis=:s WHERE id=:id";
        $this->executeQuery($sql, ['id' => $id, 'n' => $nama, 'm' => $mesin, 's' => $sasis]);
    }

    public function deleteTim($id) {
        $this->executeQuery("DELETE FROM tim WHERE id=:id", ['id' => $id]);
    }
}
?>