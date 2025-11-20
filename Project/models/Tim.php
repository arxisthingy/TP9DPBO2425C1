<?php
class Tim {
    private $id;
    private $nama_tim;
    private $mesin;
    private $sasis;

    public function __construct($id, $nama_tim, $mesin, $sasis) {
        $this->id = $id;
        $this->nama_tim = $nama_tim;
        $this->mesin = $mesin;
        $this->sasis = $sasis;
    }

    public function getId() { return $this->id; }
    public function getNamaTim() { return $this->nama_tim; }
    public function getMesin() { return $this->mesin; }
    public function getSasis() { return $this->sasis; }
}
?>