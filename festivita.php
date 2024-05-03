<?php
$mesi = [
    1 => "gennaio",
    2 => "febbraio",
    3 => "marzo",
    4 => "aprile",
    5 => "maggio",
    6 => "giugno",
    7 => "luglio",
    8 => "agosto",
    9 => "settembre",
    10 => "ottobre",
    11 => "novembre",
    12 => "dicembre"
];

include('WSfestivita.php');
$festivity_data = json_decode($json_formato, true);

$html_content = '';
foreach ($mesi as $numero_mese => $nome_mese) {
    $html_content .= '<tr>';
    $html_content .= '<td>' . $nome_mese . '</td>';
    if (isset($festivity_data[$numero_mese])) {
        foreach ($festivity_data[$numero_mese] as $festivity) {
            $html_content .= '<td>' . $festivity["data"] . '</td>';
            $html_content .= '<td>' . $festivity["nome"] . '</td>';
            $html_content .= '</tr>';
        }
    } else {
        $html_content .= '<td></td>';
        $html_content .= '<td></td>';
        $html_content .= '</tr>';
    }
}

echo $html_content;