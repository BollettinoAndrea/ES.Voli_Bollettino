<?php
require_once "funzioni.php";

$voli = caricaVoli("voli.json");

$dataFiltro = $_GET['data_filtro'] ?? null;
if (!$dataFiltro) die("Nessuna data selezionata.");

$passeggeri_filtrati = passeggeriPiuGiovani($voli, $dataFiltro);
$voli_multipli = voliConPiuPasseggeri($voli);

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Filtrati</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Risultati per data filtro: <?= htmlspecialchars($dataFiltro) ?></h1>

    <h2>Passeggeri nati dopo il <?= htmlspecialchars($dataFiltro) ?></h2>
    <?php if (count($passeggeri_filtrati) === 0): ?>
        <p>Nessun passeggero corrisponde al filtro.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Volo</th>
                <th>Nome Passeggero</th>
                <th>Data di nascita</th>
            </tr>
            <?php foreach ($passeggeri_filtrati as $p): ?>
                <tr>
                    <td><?= $p["volo"] ?></td>
                    <td><?= $p["nome"] ?></td>
                    <td><?= $p["nascita"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>


    <h2>Voli con più di un passeggero</h2>
    <?php if (count($voli_multipli) === 0): ?>
        <p>Nessun volo con più di un passeggero.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Numero volo</th>
                <th>Partenza</th>
                <th>Destinazione</th>
                <th>Numero passeggeri</th>
            </tr>
            <?php foreach ($voli_multipli as $v): ?>
                <tr>
                    <td><?= $v["numero_volo"] ?></td>
                    <td><?= $v["partenza"] ?></td>
                    <td><?= $v["destinazione"] ?></td>
                    <td><?= count($v["passeggeri"]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="index.html" class="back">« Torna al filtro</a>

</div>

</body>
</html>
