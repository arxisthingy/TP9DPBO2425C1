<?php

include_once("KontrakView.php");
include_once(__DIR__ . "/../models/Pembalap.php");

//view pembalap
class ViewPembalap implements KontrakView {

    // constructor
    public function __construct() {
    }

    // get templates from possible paths
    private function getTemplatePath($filename) {
        $path1 = __DIR__ . '/../templates/' . $filename;
        if (file_exists($path1)) return $path1;

        $path2 = __DIR__ . '/../template/' . $filename;
        if (file_exists($path2)) return $path2;

        return false;
    }

    // render list of pembalap
    public function tampilPembalap($listPembalap): string {
        $tbody = '';
        $no = 1;
        foreach ($listPembalap as $pembalap) {
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">' . $no . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getNama()) . '</td>';
            
            // Handle possible differences in method names for getting team name
            $timDisplay = method_exists($pembalap, 'getTimNama') ? $pembalap->getTimNama() : $pembalap->getTim();
            
            $tbody .= '<td>' . htmlspecialchars($timDisplay ?? '-') . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getNegara()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getPoinMusim()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getJumlahMenang()) . '</td>';
            $tbody .= '<td class="col-actions">
                        <a href="index.php?screen=edit&id=' . $pembalap->getId() . '" class="btn btn-edit">Edit</a>
                        <button data-id="' . $pembalap->getId() . '" class="btn btn-delete">Hapus</button>
                      </td>';
            $tbody .= '</tr>';
            $no++;
        }

        // skin.html path
        $templatePath = $this->getTemplatePath('skin.html');
        
        if ($templatePath) {
            $template = file_get_contents($templatePath);
            
            // Inject rows
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            
            // Inject total count
            $total = count($listPembalap);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            return $template;
        }

       // Template not found
        return "<div <p>template not found.</p> </div>";
    }

    public function tampilFormPembalap($data = null, $listTim = []): string {
        // skin form_pembalap.html path
        $templatePath = $this->getTemplatePath('form_pembalap.html');
        
        // load template
        if ($templatePath) {
            $template = file_get_contents($templatePath);
        } else {
             return "<div style='color:red; padding:20px;'>Error: File 'form_pembalap.html' tidak ditemukan di folder template/templates.</div>";
        }

        // prepare tim select options
        $tim_id_selected = $data['tim_id'] ?? '';
        
        // build select HTML
        $selectHtml = "<select name='tim_id' required style='width:100%; padding:8px; margin-top:5px; border:1px solid #e6e9ef; border-radius:6px;'>";
        $selectHtml .= "<option value=''>-- Pilih Tim --</option>";
        foreach($listTim as $t) {
            $tId = is_object($t) ? $t->getId() : ($t['id'] ?? '');
            $tNama = is_object($t) ? $t->getNamaTim() : ($t['nama_tim'] ?? $t['nama'] ?? '');
            
            $selected = ($tId == $tim_id_selected) ? "selected" : "";
            $selectHtml .= "<option value='{$tId}' $selected>{$tNama}</option>";
        }
        $selectHtml .= "</select>";

        // replace placeholders
        $action = $data ? 'update' : 'store';
        $id = $data['id'] ?? '';

        // replace data on template
        $template = str_replace('DATA_ACTION', $action, $template);
        $template = str_replace('DATA_ID', $id, $template);
        $template = str_replace('DATA_NAMA', htmlspecialchars($data['nama'] ?? ''), $template);
        $template = str_replace('DATA_NEGARA', htmlspecialchars($data['negara'] ?? ''), $template);
        $template = str_replace('DATA_POIN', htmlspecialchars($data['poinMusim'] ?? ''), $template);
        $template = str_replace('DATA_MENANG', htmlspecialchars($data['jumlahMenang'] ?? ''), $template);
        
        // inject tim select options
        $template = str_replace('<!-- DATA_TIM_SELECT -->', $selectHtml, $template);

        return $template;
    }
}
?>