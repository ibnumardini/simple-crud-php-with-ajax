<?php

include "db.php";

$id = $_POST["id"];
$judulBuku = $_POST["judulBuku"];
$pengarang = $_POST["pengarang"];
$tahunTerbit = $_POST["tahunTerbit"];

$result['pesan'] = "";

if (empty($judulBuku) && $judulBuku == "") {
    $result['pesan'] = "Judul Buku Wajib di isi!.";
} elseif (empty($pengarang) && $pengarang == "") {
    $result['pesan'] = "Pengarang wajib di isi.";
} elseif (empty($tahunTerbit) && $tahunTerbit == "") {
    $result['pesan'] = "Tahun terbit wajib di isi.";
} else {
    $queryResult = $db->query("UPDATE tb_buku SET judul_buku='" . $judulBuku . "', pengarang='" . $pengarang . "', tahun_terbit='" . $tahunTerbit . "' WHERE id = '" . $id . "' ");
    if ($queryResult) {
        $result['pesan'] = "Data berhasil di ubah!";
    } else {
        $result['pesan'] = "Data gagal di ubah!";
    }
}

echo json_encode($result);
