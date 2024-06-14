<?php
class FootballService {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=championnat', 'root', '');
    }

    public function getMatchScores($match_id) {
        $stmt = $this->db->prepare('SELECT * FROM Matches WHERE id = ?');
        $stmt->execute([$match_id]);
        $match = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($match) {
            return json_encode($match);
        } else {
            return json_encode(['Erreur' => 'Match non trouvé']);
        }
    }

    public function addMatchResult($match_id, $score_team1, $score_team2) {
        $stmt = $this->db->prepare('UPDATE Matches SET score_team1 = ?, score_team2 = ? WHERE id = ?');
        $stmt->execute([$score_team1, $score_team2, $match_id]);

        if ($stmt->rowCount() > 0) {
            return json_encode(['Success' => 'Résultat du match ajouté']);
        } else {
            return json_encode(['Erreur' => 'Impossible d\'ajouter le résultat du match']);
        }
    }
}

$options = [
    'uri' => 'http://localhost/devoirajax/wsdl',
    'location' => 'http://localhost/devoirajax/service.php'
];

$server = new SoapServer('service.wsdl', $options);
$server->setClass('FootballService');
$server->handle();
?>
