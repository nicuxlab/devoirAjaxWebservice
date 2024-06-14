<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["team1"]) && isset($_POST["team2"]) && isset($_POST["score1"]) && isset($_POST["score2"]) && isset($_POST["matchDate"])) {
    $client = new SoapClient('http://localhost/devoirajax/service.wsdl');

    try {
        $result = $client->addMatchResult(1, $_POST["team1"], $_POST["team2"], $_POST["score1"], $_POST["score2"], $_POST["matchDate"]);
        echo $result;
    } catch (SoapFault $e) {
        echo "Une erreur s'est produite : {$e->getMessage()}";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Football Match Scores</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 text-center">BIENVENUE AU CHAMPIONNAT BENINOIS</h1>
        <h3 class="mt-4 text-center">Ajouter un résultat de match</h3>

        <form id="matchForm" methode="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="team1"><strong>Équipe 1</strong></label>
                        <input type="text" class="form-control" id="team1" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="team2"><strong>Équipe 2</strong></label>
                        <input type="text" class="form-control" id="team2" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="score1"><strong>Score Équipe 1</strong></label>
                        <input type="number" class="form-control" id="score1" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="score2"><strong>Score Équipe 2</strong></label>
                        <input type="number" class="form-control" id="score2" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="matchDate"><strong>Date et heure du Match</strong></label>
                        <input type="datetime-local" class="form-control" id="matchDate" required>
                    </div>
                </div>
                <div class="col-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                </div>
            </div>
        </form>
        <div id="result" class="mt-4"></div>

        <h2 class="mt-4">Résultats des matchs</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Équipe 1</th>
                    <th>Score Équipe 1</th>
                    <th>Équipe 2</th>
                    <th>Score Équipe 2</th>
                    <th>Date et Heure</th>
                </tr>
            </thead>
            <tbody id="matchResults">
               
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Récupérer les résultats des matchs existants
            $.ajax({
                url: 'get_match.php',
                type: 'GET',
                success: function(response) {
                    $('#matchResults').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#matchResults').html('<tr><td colspan="5">Erreur lors de la récupération des résultats des matchs.</td></tr>');
                }
            });

            // Ajouter un résultat de match
            $('#matchForm').on('submit', function(e) {
                e.preventDefault();

                const matchData = {
                    team1: $('#team1').val(),
                    team2: $('#team2').val(),
                    score1: $('#score1').val(),
                    score2: $('#score2').val(),
                    matchDate: $('#matchDate').val()
                };

                $.ajax({
                    url: 'index.php',
                    type: 'POST',
                    data: matchData,
                    success: function(response) {
                        $('#result').html(response);
                        // Ajouter le nouveau match au tableau
                        $('#matchResults').append(`
                            <tr>
                                <td>${matchData.team1}</td>
                                <td>${matchData.score1}</td>
                                <td>${matchData.team2}</td>
                                <td>${matchData.score2}</td>
                                <td>${matchData.matchDate}</td>
                            </tr>
                        `);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#result').html('Erreur : ' + textStatus);
                    }
                });
            });
        });
    </script>
</body>
</html>
