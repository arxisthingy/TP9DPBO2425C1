<?php

/*
    KontrakModelTim.php
    Interface untuk model Tim
*/

interface KontrakModelTim
{
    public function getAllTim();
    public function getTimById($id);
    
    public function addTim($nama, $mesin, $sasis);
    public function updateTim($id, $nama, $mesin, $sasis);
    public function deleteTim($id);
}
?>