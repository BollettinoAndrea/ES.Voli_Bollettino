<?php
if (!isset($_GET['data_filtro'])) {
    header("Location: index.html");
    exit;
}

$data_filtro = $_GET['data_filtro'];
header("Location: voli.php?data_filtro=" . $data_filtro);
exit;
