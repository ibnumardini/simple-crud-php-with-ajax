<?php

include "db.php";

$id = $_POST["id"];

$db->query("DELETE FROM tb_buku WHERE id=".$id);