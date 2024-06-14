<?php
$client = new SoapClient('http://localhost/devoirajax/service.wsdl');

try {
    // Appel de la méthode getMatchScores
    $result = $client->getMatchScores(1);
    echo "Résultat du match : " . $result . "<br>";

    // Appel de la méthode addMatchResult
    $result = $client->addMatchResult(1, 2, 1); 

    echo "Ajout du résultat du match : " . $result;
} catch (SoapFault $e) {
    echo "Une erreur s'est produite : {$e->getMessage()}";
}
?>
