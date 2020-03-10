<?php 

include "db.php";

$id = $_POST["id"];
$result = array();
$queryresult = $db->query("SELECT * FROM tb_buku WHERE id=".$id);
$fetchData = $queryresult->fetch_assoc();

$result = $fetchData;

echo json_encode($result);

?>