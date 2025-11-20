<?php
require_once("DB.php");
require_once("KontrakModelTim.php");

// TabelTim implements from KontrakModelTim
class TabelTim extends DB implements KontrakModelTim { 
    
    // db constructor
    public function __construct($db) {
        parent::__construct($db->host, $db->db_name, $db->username, $db->password);
    }

    // get all tim function
    public function getAllTim() {
        $this->executeQuery("SELECT * FROM tim ORDER BY nama_tim ASC");
        return $this->getAllResult();
    }

    // get tim by id function
    public function getTimById($id) {
        $this->executeQuery("SELECT * FROM tim WHERE id = :id", ['id' => $id]);
        $res = $this->getAllResult();
        return $res[0] ?? null;
    }

    // add tim function
    public function addTim($nama, $mesin, $sasis) {
        $sql = "INSERT INTO tim (nama_tim, mesin, sasis) VALUES (:n, :m, :s)";
        $this->executeQuery($sql, ['n' => $nama, 'm' => $mesin, 's' => $sasis]);
    }

    // update tim function
    public function updateTim($id, $nama, $mesin, $sasis) {
        $sql = "UPDATE tim SET nama_tim=:n, mesin=:m, sasis=:s WHERE id=:id";
        $this->executeQuery($sql, ['id' => $id, 'n' => $nama, 'm' => $mesin, 's' => $sasis]);
    }

    // delete tim function
    public function deleteTim($id) {
        $this->executeQuery("DELETE FROM tim WHERE id=:id", ['id' => $id]);
    }
}
?>