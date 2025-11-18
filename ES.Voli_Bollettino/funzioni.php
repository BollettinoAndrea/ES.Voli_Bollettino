<?php

function caricaVoli($file) {
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    return json_decode($json, true);
}

function passeggeriPiuGiovani($voli, $dataFiltro) {
    $risultati = [];

    foreach ($voli as $volo) {
        foreach ($volo['passeggeri'] as $passeggero) {
            if ($passeggero['data_di_nascita'] > $dataFiltro) {
                $risultati[] = [
                    "volo" => $volo["numero_volo"],
                    "nome" => $passeggero["nome"],
                    "nascita" => $passeggero["data_di_nascita"]
                ];
            }
        }
    }

    return $risultati;
}

function voliConPiuPasseggeri($voli) {
    return array_filter($voli, function($volo) {
        return count($volo['passeggeri']) > 1;
    });
}
