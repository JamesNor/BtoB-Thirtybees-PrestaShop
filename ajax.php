<?php

$term = $_GET['term'];

try {
    $dbh = new PDO('mysql:host=localhost;dbname=thirtybees', "thirtybees", "thirtybees");
    $requete = $dbh->prepare('SELECT * FROM tb_gsbtob WHERE name LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
    $requete->execute(array('term' => '%'.$term.'%'));

    $array = array(); // on créé le tableau

    while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
    {
        array_push($array, $donnee['name']); // et on ajoute celles-ci à notre tableau
    }
    echo json_encode($array);

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>
