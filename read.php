<?php

include "db.php";

$query = $db->query("SELECT * FROM tb_buku");
$result = array();

while ($fetch = $query->fetch_assoc()) {
    $result[] = $fetch;
}

echo json_encode($result);
