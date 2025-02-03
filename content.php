<?php
if (isset($_GET['module'])) {
    $module = $_GET['module'];

    //menu utama sidebar
    if ($module == 'beranda') {//index
        include "content/beranda.php";
    } elseif ($module == 'ipds') {//ipds
        include "content/ipds.php";
    } elseif ($module == 'fungsi_lain') {//fungsi lain
        include "content/fungsi_lain.php";
    } elseif ($module == 'surat tugas') {//surat tugas
        include "content/surat_tugas.php";

    //menu ipds
    } elseif ($module == 'aneh') {//(aneh, dls, ipd, jrs)
        include "content/ipds/aneh.php";
    } elseif ($module == 'dls') {
        include "content/ipds/dls.php";
    } elseif ($module == 'ipd') {
        include "content/ipds/ipd.php";
    } elseif ($module == 'jrs') {
        include "content/ipds/jrs.php";

    //menu fungsi lain
    } elseif ($module == 'nerwilis') {//(nerwilis, produksi, sosial, distribusi)
        include "content/fungsi_lain/nerwilis.php";
    } elseif ($module == 'produksi') {
        include "content/fungsi_lain/produksi.php";
    } elseif ($module == 'sosial') {
        include "content/fungsi_lain/sosial.php";
    } elseif ($module == 'distribusi') {
        include "content/fungsi_lain/distribusi.php";
    }
} else {
    // Jika tidak ada parameter module, arahkan ke 'beranda' sebagai default
    include "content/beranda.php";
}