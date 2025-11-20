<?php

include_once("KontrakView.php");
include_once(__DIR__ . "/../models/Pembalap.php");

class ViewPembalap implements KontrakView {

    public function __construct() {
        // Konstruktor kosong
    }

    // --- FUNGSI BANTUAN UNTUK MENCARI TEMPLATE ---
    private function getTemplatePath($filename) {
        // Cek folder 'templates' (pakai s)
        $path1 = __DIR__ . '/../templates/' . $filename;
        if (file_exists($path1)) return $path1;

        // Cek folder 'template' (tanpa s)
        $path2 = __DIR__ . '/../template/' . $filename;
        if (file_exists($path2)) return $path2;

        return false;
    }
    // ---------------------------------------------

    public function tampilPembalap($listPembalap): string {
        $tbody = '';
        $no = 1;
        foreach ($listPembalap as $pembalap) {
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">' . $no . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getNama()) . '</td>';
            
            // Cek apakah object punya method getTimNama (hasil join) atau cuma getTim
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

        // Cari file skin.html di kedua kemungkinan folder
        $templatePath = $this->getTemplatePath('skin.html');
        
        if ($templatePath) {
            $template = file_get_contents($templatePath);
            
            // Masukkan baris data ke tabel
            $template = str_replace('<!-- PHP will inject rows here -->', $tbody, $template);
            
            // Update Total
            $total = count($listPembalap);
            $template = str_replace('Total:', 'Total: ' . $total, $template);
            
            // CATATAN: Logika inject tombol 'Kelola Tim' DIHAPUS disini 
            // karena tombol tersebut sudah ada permanen di file skin.html
            // agar tidak terjadi error layout (button hilang/rusak).

            return $template;
        }

        // Kalau masih tidak ketemu juga, tampilkan error JELAS (bukan cuma data mentah)
        return "<div style='padding:20px; font-family:sans-serif; color:red; border:1px solid red; background:#fee;'>
                    <h3>Error: File Template Tidak Ditemukan!</h3>
                    <p>Sistem mencari 'skin.html' di folder <b>templates/</b> atau <b>template/</b> tapi tidak ketemu.</p>
                    <p>Pastikan kamu sudah membuat folder bernama <b>templates</b> sejajar dengan folder views, dan di dalamnya ada file <b>skin.html</b>.</p>
                    <hr>
                    <p>Data Mentah:</p>
                    <table border='1'>$tbody</table>
                </div>";
    }

    public function tampilFormPembalap($data = null, $listTim = []): string {
        // Cari file form_pembalap.html
        $templatePath = $this->getTemplatePath('form_pembalap.html');
        
        if ($templatePath) {
            $template = file_get_contents($templatePath);
        } else {
             return "<div style='color:red; padding:20px;'>Error: File 'form_pembalap.html' tidak ditemukan di folder template/templates.</div>";
        }

        $tim_id_selected = $data['tim_id'] ?? '';
        
        $selectHtml = "<select name='tim_id' required style='width:100%; padding:8px; margin-top:5px; border:1px solid #e6e9ef; border-radius:6px;'>";
        $selectHtml .= "<option value=''>-- Pilih Tim --</option>";
        foreach($listTim as $t) {
            $tId = is_object($t) ? $t->getId() : ($t['id'] ?? '');
            $tNama = is_object($t) ? $t->getNamaTim() : ($t['nama_tim'] ?? $t['nama'] ?? '');
            
            $selected = ($tId == $tim_id_selected) ? "selected" : "";
            $selectHtml .= "<option value='{$tId}' $selected>{$tNama}</option>";
        }
        $selectHtml .= "</select>";

        $action = $data ? 'update' : 'store';
        $id = $data['id'] ?? '';

        $template = str_replace('DATA_ACTION', $action, $template);
        $template = str_replace('DATA_ID', $id, $template);
        $template = str_replace('DATA_NAMA', htmlspecialchars($data['nama'] ?? ''), $template);
        $template = str_replace('DATA_NEGARA', htmlspecialchars($data['negara'] ?? ''), $template);
        $template = str_replace('DATA_POIN', htmlspecialchars($data['poinMusim'] ?? ''), $template);
        $template = str_replace('DATA_MENANG', htmlspecialchars($data['jumlahMenang'] ?? ''), $template);
        
        $template = str_replace('<!-- DATA_TIM_SELECT -->', $selectHtml, $template);

        return $template;
    }
}
?>