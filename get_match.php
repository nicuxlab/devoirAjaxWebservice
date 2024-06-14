<?php
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=championnat', 'root', '');

// Requête SQL pour récupérer les résultats des matchs
$stmt = $db->query('SELECT m.*, t1.name as team1_name, t2.name as team2_name FROM Matches m JOIN Teams t1 ON m.team1_id = t1.id JOIN Teams t2 ON m.team2_id = t2.id');
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

$table = '<tr><th>Équipe 1</th><th>Score Équipe 1</th><th>Équipe 2</th><th>Score Équipe 2</th><th>Date et Heure</th></tr>';
foreach ($matches as $match) {
    $table .= '<tr>';
    $table .= '<td>' . $match['team1_name'] . '</td>';
    $table .= '<td>' . $match['score_team1'] . '</td>';
    $table .= '<td>' . $match['team2_name'] . '</td>';
    $table .= '<td>' . $match['score_team2'] . '</td>';
    $table .= '<td>' . $match['match_date'] . '</td>';
    $table .= '</tr>';
}

// Renvoyer le tableau HTML
echo $table;
?>
