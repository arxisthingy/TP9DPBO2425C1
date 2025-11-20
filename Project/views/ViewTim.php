<?php

include_once(__DIR__ . "/../models/Tim.php");

class ViewTim {
    
    public function tampilList($listTim) {
        $rows = "";
        foreach($listTim as $t){
            $rows .= "<tr>";
            $rows .= "<td>" . htmlspecialchars($t->getNamaTim()) . "</td>";
            $rows .= "<td class='col-mesin'>" . htmlspecialchars($t->getMesin()) . "</td>";
            $rows .= "<td class='col-sasis'>" . htmlspecialchars($t->getSasis()) . "</td>";
            $rows .= "<td class='col-actions'>
                <a href='index.php?page=tim&act=edit&id={$t->getId()}' class='btn btn-edit'>Edit</a>
                <button data-id='{$t->getId()}' class='btn btn-delete'>Hapus</button>
            </td>";
            $rows .= "</tr>";
        }

        $templatePath = __DIR__ . '/../template/skin_tim.html';
        
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $template = str_replace('<!-- PHP will inject rows here -->', $rows, $template);
            $total = count($listTim);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            return $template;
        }

        return "Error: File template/skin_tim.html tidak ditemukan! <br> <table border='1'>$rows</table>";
    }

    public function tampilForm($data = null) {
        $templatePath = __DIR__ . '/../template/form_tim.html';
        
        if (file_exists($templatePath)) {
            $html = file_get_contents($templatePath);
        } else {
            return "<h3 style='color:red'>Error: Template form_tim.html tidak ditemukan!</h3>";
        }
        
        $action = $data ? 'update' : 'store';
        $id = $data['id'] ?? '';
        $nama = $data['nama_tim'] ?? '';
        $mesin = $data['mesin'] ?? '';
        $sasis = $data['sasis'] ?? '';

        $html = str_replace('DATA_ACTION', $action, $html);
        $html = str_replace('DATA_ID', $id, $html);
        $html = str_replace('DATA_NAMA', htmlspecialchars($nama), $html);
        $html = str_replace('DATA_MESIN', htmlspecialchars($mesin), $html);
        $html = str_replace('DATA_SASIS', htmlspecialchars($sasis), $html);

        return $html;
    }
}
?>