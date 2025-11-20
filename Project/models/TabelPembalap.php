<?php
require_once("DB.php");
require_once("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    // Constructor menerima object $db (dari index.php)
    public function __construct($db) {
        parent::__construct($db->host, $db->db_name, $db->username, $db->password);
    }

    public function getAllPembalap(): array {
        $query = "SELECT p.*, t.nama_tim 
                  FROM pembalap p 
                  LEFT JOIN tim t ON p.tim_id = t.id 
                  ORDER BY p.id DESC";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getPembalapById($id): ?array {
        $this->executeQuery("SELECT * FROM pembalap WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addPembalap($nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        $query = "INSERT INTO pembalap (nama, tim_id, negara, poinMusim, jumlahMenang) 
                  VALUES (:nama, :tim, :negara, :poin, :menang)";
        $params = [
            'nama' => $nama,
            'tim' => $tim_id, // Pastikan ini tim_id (INT)
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ];
        $this->executeQuery($query, $params);
    }

    public function updatePembalap($id, $nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        $query = "UPDATE pembalap 
                  SET nama = :nama, tim_id = :tim, negara = :negara, 
                      poinMusim = :poin, jumlahMenang = :menang 
                  WHERE id = :id";
        $params = [
            'id' => $id,
            'nama' => $nama,
            'tim' => $tim_id,
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ];
        $this->executeQuery($query, $params);
    }

    public function deletePembalap($id): void {
        $this->executeQuery("DELETE FROM pembalap WHERE id = :id", ['id' => $id]);
    }
}
?>