<?php
// Ce code est juste un plus pour me permettre de récupérer le résultat des matchs 
// au chargement de la page. sur index.php

$db = new PDO('mysql:host=localhost;dbname=championnat', 'root', '');

$stmt = $db->query('SELECT * FROM Matches');
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

$table = '<tr><th>Équipe 1</th><th>Score Équipe 1</th><th>Équipe 2</th><th>Score Équipe 2</th><th>Date et Heure</th></tr>';
foreach ($matches as $match) {
    $table .= '<tr>';
    $table .= '<td>' . $match['team1_id'] . '</td>';
    $table .= '<td>' . $match['score_team1'] . '</td>';
    $table .= '<td>' . $match['team2_id'] . '</td>';
    $table .= '<td>' . $match['score_team2'] . '</td>';
    $table .= '<td>' . $match['match_date'] . '</td>';
    $table .= '</tr>';
}

// Renvoyer le tableau HTML
echo $table;
?>
