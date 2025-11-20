<?php
require_once("models/Tim.php");

class PresenterTim {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function prosesTampilList() {
        $data = $this->model->getAllTim();
        $objs = [];
        foreach($data as $d) {
            $objs[] = new Tim($d['id'], $d['nama_tim'], $d['mesin'], $d['sasis']);
        }
        return $this->view->tampilList($objs);
    }

    public function prosesTampilForm($id = null) {
        $data = null;
        if($id) $data = $this->model->getTimById($id);
        return $this->view->tampilForm($data);
    }

    public function prosesTambah($nama, $mesin, $sasis) {
        $this->model->addTim($nama, $mesin, $sasis);
    }

    public function prosesUbah($id, $nama, $mesin, $sasis) {
        $this->model->updateTim($id, $nama, $mesin, $sasis);
    }

    public function prosesHapus($id) {
        $this->model->deleteTim($id);
    }
}
?>