<?php
require_once("models/Pembalap.php");

// PresenterPembalap
class PresenterPembalap {
    private $modelPembalap;
    private $modelTim;
    private $view;

    // constructor
    public function __construct($modelPembalap, $modelTim, $view) {
        $this->modelPembalap = $modelPembalap;
        $this->modelTim = $modelTim;
        $this->view = $view;
    }

    // return data as list of Pembalap objects
    public function prosesTampilList() {
        $data = $this->modelPembalap->getAllPembalap();
        $objects = [];
        foreach($data as $row){
            $objects[] = new Pembalap(
                $row['id'], 
                $row['nama'], 
                $row['tim_id'],
                $row['nama_tim'], 
                $row['negara'], 
                $row['poinMusim'], 
                $row['jumlahMenang']
            );
        }
        // render view
        return $this->view->tampilPembalap($objects);
    }

    // show form for add or edit
    public function prosesTampilForm($id = null) {
        $dataPembalap = null;
        if($id) {
            $dataPembalap = $this->modelPembalap->getPembalapById($id);
        }
        $listTim = $this->modelTim->getAllTim();
        
        return $this->view->tampilFormPembalap($dataPembalap, $listTim);
    }

    // process add, edit, delete
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