<?php
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelTim.php");

include_once("views/ViewPembalap.php");
include_once("views/ViewTim.php");

include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterTim.php");

// 1. KONFIGURASI DB
$dbConfig = (object)[
    'host' => 'localhost',
    'db_name' => 'mvp_db',
    'username' => 'root',
    'password' => '' 
];

// 2. INISIALISASI MODEL
$tabelTim = new TabelTim($dbConfig);
$tabelPembalap = new TabelPembalap($dbConfig);

// 3. ROUTING HALAMAN
$page = $_GET['page'] ?? 'pembalap';

if ($page == 'pembalap') {
    $viewPembalap = new ViewPembalap();
    $presenter = new PresenterPembalap($tabelPembalap, $tabelTim, $viewPembalap);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $act = $_POST['action'] ?? '';
        
        if ($act == 'store') {
            $presenter->prosesTambah($_POST['nama'], $_POST['tim_id'], $_POST['negara'], $_POST['poin'], $_POST['menang']);
        } elseif ($act == 'update') {
            $presenter->prosesUbah($_POST['id'], $_POST['nama'], $_POST['tim_id'], $_POST['negara'], $_POST['poin'], $_POST['menang']);
        } elseif ($act == 'delete') {
            $presenter->prosesHapus($_POST['id']);
        }
        
        header("Location: index.php?page=pembalap");
        exit;
    }

    $screen = $_GET['screen'] ?? 'list';
    if ($screen == 'add') {
        echo $presenter->prosesTampilForm();
    } elseif ($screen == 'edit') {
        echo $presenter->prosesTampilForm($_GET['id']);
    } else {
        echo $presenter->prosesTampilList();
    }

} elseif ($page == 'tim') {
    $viewTim = new ViewTim();
    $presenterTim = new PresenterTim($tabelTim, $viewTim);

    // HANDLE POST REQUEST (Termasuk Delete Tim)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $act = $_POST['action'] ?? '';

        if($act == 'store') {
            $presenterTim->prosesTambah($_POST['nama_tim'], $_POST['mesin'], $_POST['sasis']);
        } elseif($act == 'update') {
            $presenterTim->prosesUbah($_POST['id'], $_POST['nama_tim'], $_POST['mesin'], $_POST['sasis']);
        } elseif($act == 'delete') {
            // Ini logika yang menjalankan penghapusan
            $presenterTim->prosesHapus($_POST['id']);
        }

        header("Location: index.php?page=tim");
        exit;
    }

    // HANDLE GET REQUEST
    $act = $_GET['act'] ?? 'list';
    
    if ($act == 'add') {
        echo $presenterTim->prosesTampilForm();
    } elseif ($act == 'edit') {
        echo $presenterTim->prosesTampilForm($_GET['id']);
    } else {
        echo $presenterTim->prosesTampilList();
    }
}
?>