<?php
require_once("models/Pembalap.php");

class PresenterPembalap {
    private $modelPembalap;
    private $modelTim;
    private $view;

    public function __construct($modelPembalap, $modelTim, $view) {
        $this->modelPembalap = $modelPembalap;
        $this->modelTim = $modelTim;
        $this->view = $view;
    }

    public function prosesTampilList() {
        $data = $this->modelPembalap->getAllPembalap();
        $objects = [];
        foreach($data as $row){
            // Pass ID dan Nama Tim ke Object
            $objects[] = new Pembalap(
                $row['id'], 
                $row['nama'], 
                $row['tim_id'],
                $row['nama_tim'], // Dari hasil JOIN 
                $row['negara'], 
                $row['poinMusim'], 
                $row['jumlahMenang']
            );
        }
        return $this->view->tampilPembalap($objects);
    }

    public function prosesTampilForm($id = null) {
        $dataPembalap = null;
        if($id) {
            $dataPembalap = $this->modelPembalap->getPembalapById($id);
        }
        $listTim = $this->modelTim->getAllTim();
        
        return $this->view->tampilFormPembalap($dataPembalap, $listTim);
    }

    public function prosesTambah($nama, $tim_id, $negara, $poin, $menang) {
        $this->modelPembalap->addPembalap($nama, $tim_id, $negara, $poin, $menang);
    }

    public function prosesUbah($id, $nama, $tim_id, $negara, $poin, $menang) {
        $this->modelPembalap->updatePembalap($id, $nama, $tim_id, $negara, $poin, $menang);
    }

    public function prosesHapus($id) {
        $this->modelPembalap->deletePembalap($id);
    }
}
?>