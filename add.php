<?php

include "db.php";

$judulBuku = $_POST["judulBuku"];
$pengarang = $_POST["pengarang"];
$tahunTerbit = $_POST["tahunTerbit"];
$result['pesan'] = "";

if (empty($judulBuku) && $judulBuku == "") {
    $result['pesan'] = "Judul Buk Wajib di isi!.";
} elseif (empty($pengarang) && $pengarang == "") {
    $result['pesan'] = "Pengarang wajib di isi.";
} elseif (empty($tahunTerbit) && $tahunTerbit == "") {
    $result['pesan'] = "Tahun terbit wajib di isi.";
} else {
    $queryResult = $db->query("INSERT INTO tb_buku (judul_buku,pengarang,tahun_terbit) VALUES ('" . $judulBuku . "','" . $pengarang . "','" . $tahunTerbit . "')");
    if ($queryResult) {
        $result['pesan'] = "Data berhasil di tambahkan!";
    } else {
        $result['pesan'] = "Data gagal di tambahkan!";
    }
}

echo json_encode($result);
