<?php
require_once("DB.php");
require_once("KontrakModel.php");

// TabelPembalap mengimplementasi KontrakModel
class TabelPembalap extends DB implements KontrakModel {

    // Constructor 
    public function __construct($db) {
        parent::__construct($db->host, $db->db_name, $db->username, $db->password);
    }

    // get all pembalap function
    public function getAllPembalap(): array {
        $query = "SELECT p.*, t.nama_tim 
                  FROM pembalap p 
                  LEFT JOIN tim t ON p.tim_id = t.id 
                  ORDER BY p.poinMusim DESC"; 
        
        $this->executeQuery($query);
        return $this->getAllResult();
    }


    // function to get pembalap by id
    public function getPembalapById($id): ?array {
        $this->executeQuery("SELECT * FROM pembalap WHERE id = :id", ['id' => $id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    public function addPembalap($nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        // query
        $query = "INSERT INTO pembalap (nama, tim_id, negara, poinMusim, jumlahMenang) 
                  VALUES (:nama, :tim, :negara, :poin, :menang)";
        // params
        $params = [
            'nama' => $nama,
            'tim' => $tim_id, // Pastikan ini tim_id (INT)
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ];
        $this->executeQuery($query, $params); // exec query
    }

    // update pembalap function
    public function updatePembalap($id, $nama, $tim_id, $negara, $poinMusim, $jumlahMenang): void {
        // query
        $query = "UPDATE pembalap 
                  SET nama = :nama, tim_id = :tim, negara = :negara, 
                      poinMusim = :poin, jumlahMenang = :menang 
                  WHERE id = :id";
        // params
        $params = [
            'id' => $id,
            'nama' => $nama,
            'tim' => $tim_id,
            'negara' => $negara,
            'poin' => $poinMusim,
            'menang' => $jumlahMenang
        ];
        // exectue query
        $this->executeQuery($query, $params);
    }

    public function deletePembalap($id): void {
        // delete query
        $this->executeQuery("DELETE FROM pembalap WHERE id = :id", ['id' => $id]);
    }
}
?>