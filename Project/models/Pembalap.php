<?php
/*
    Pembalap.php
    Model untuk entitas Pembalap
*/
class Pembalap {
    private $id;
    private $nama;
    private $tim_id;   // ID untuk Logic/Form
    private $tim_nama; // String untuk Tampilan Tabel
    private $negara;
    private $poinMusim;
    private $jumlahMenang;

    public function __construct($id, $nama, $tim_id, $tim_nama, $negara, $poinMusim, $jumlahMenang){
        $this->id = $id;
        $this->nama = $nama;
        $this->tim_id = $tim_id;
        $this->tim_nama = $tim_nama;
        $this->negara = $negara;
        $this->poinMusim = $poinMusim;
        $this->jumlahMenang = $jumlahMenang;
    }

    public function getId() { return $this->id; }
    public function getNama() { return $this->nama; }
    public function getTimId() { return $this->tim_id; }
    public function getTimNama() { return $this->tim_nama; }
    public function getNegara() { return $this->negara; }
    public function getPoinMusim() { return $this->poinMusim; }
    public function getJumlahMenang() { return $this->jumlahMenang; }
}
?>