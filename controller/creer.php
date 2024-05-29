<?php

require_once "Model/repository/connexion.php";

use Model\repository\MovieDao;
use Model\repository\ActorDao;
use Model\repository\RoleDao;
use Model\entity\Movie;
use Model\entity\Actor;
use Model\entity\Role;

echo $twig->render('creer.html.twig', ['erreur' => 404]);

// ---------------- V3 ----------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si tous les champs nécessaires sont présents
    if (isset($_POST['title'], $_POST['year'], $_POST['poster'], $_POST['director'], $_POST['character'], $_POST['name'], $_POST['firstname'])) {
        
        // Récupération des données du formulaire
        $title = $_POST['title'];
        $year = $_POST['year'];
        $poster = $_POST['poster'];
        $director = $_POST['director'];
        $characters = $_POST['character'];
        $names = $_POST['name'];
        $firstnames = $_POST['firstname'];
        
        // Vérification des champs (ici, juste un exemple basique)
        if (empty($title)) {
            echo "Veuillez renseigner un titre";
        } elseif (empty($year)) {
            echo "Veuillez renseigner une année";
        } elseif (empty($poster)) {
            echo "Veuillez ajouter une affiche";
        } elseif (empty($director)) {
            echo "Veuillez renseigner un réalisateur";
        } elseif (empty($characters)) {
            echo "Veuillez renseigner un personnage";
        } elseif (empty($names)) {
            echo "Veuillez renseigner le nom de l'acteur/actrice";
        } elseif (empty($firstnames)) {
            echo "Veuillez renseigner le prénom de l'acteur/actrice";
        } else {
            // Création des rôles
            $roles = [];
            for ($i = 0; $i < count($characters); $i++) {
                $actor = new Actor(null, $names[$i], $firstnames[$i]);
                $role = new Role(null, $characters[$i], $actor);
                $roles[] = $role;
            }

            $movie = new Movie(null, $_POST['title'], $_POST['director'], $_POST['poster'], $_POST['year'], $roles);

            // Ajout du film dans la BDD
            MovieDao::addOne($movie);
            $idMovie = BDD->lastInsertId();

            foreach ($roles as $role) {
                $actor = $role->getActor();
                ActorDao::addOne($actor->getName(), $actor->getFirstname());
                $idActor = BDD->lastInsertId();
                RoleDao::addOne($idMovie, $idActor, $role->getCharacter());
            }

            echo "Film, acteurs et rôles ajoutés avec succès !";
        }
    } else {
        echo "Tous les champs du formulaire doivent être remplis.";
    }
}






// ---------------- V2 ----------------

// //Récupère les champs

// if (isset($_POST['title']) && isset($_POST['years']) && isset($_POST['poster']) &&
//     isset($_POST['director']) && isset($_POST['character']) && isset($_POST['name']) && isset($_POST['firstname'])) {

//         $roles = [];
//         for ($i=0; $i < count($_POST['character']) ; $i++) { 
//             $actor = new Actor(null, $_POST['name'][$i], $_POST['firstname'][$i]);
//             $role = new Role(null, $_POST['character'], $actor[$i]);
//             $roles[] = $role;
//         }

// // if ($_SERVER["REQUEST_METHOD"] == "POST") {
// //     $title = $_POST['title'];
// //     $years = $_POST['years'];
// //     $poster = $_POST['poster'];
// //     $director = $_POST['director'];
// //     $character = $_POST['character'];
// //     $name = $_POST['name'];
// //     $firstname = $_POST['firstname'];
// //     $roles = $_POST['roles'] ?? [];

//     // Vérification des champs
//     // if ($title === '') {
//     //     echo  "Veuillez renseigner un titre";
//     // } elseif ($years === '') {
//     //     echo  "Veuillez renseigner une année";
//     // } elseif ($poster === '') {
//     //     echo  "Veuillez ajouter une affiche";
//     // } elseif ($director === '') {
//     //     echo  "Veuillez renseigner un réalisateur";
//     // } elseif ($character === '') {
//     //     echo  "Veuillez renseigner un personnage";
//     // } elseif ($name === '') {
//     //     echo  "Veuillez renseigner le nom de l'acteur/actrice";
//     // } elseif ($firstname === '') {
//     //     echo  "Veuillez renseigner le prénom de l'acteur/actrice";
//     // } else {
        
//         // Ajoute le film dans la BDD
//         MovieDao::addOne($title, $years, $poster, $director);
//         $idMovie = BDD->lastInsertId();
//         ActorDao::addOne($name, $firstname);
//         $idActor = BDD->lastInsertId();
//         RoleDao::addOne($idMovie, $idActor, $character);



//         // if ($MovieDao->createMovie($movie)) {

//         // } else {

//         // }
//     }






// ---------------- V1 ----------------

// // if (isset($_POST['title']) && isset($_POST['year']) && isset($_POST['poster']) &&
// //     isset($_POST['director']) && isset($_POST['character1']) && isset($_POST['name1']) && isset($_POST['firstname1'])) {

// //     $roles = [];
// //     for ($i=0; $i < count($_POST['character']) ; $i++) { 
// //         $actor = new Actor(null, $_POST['name'][$i], $_POST['firstname'][$i]);
// //         $role = new Role(null, $actor, $_POST['character'][$i]);
// //         $roles[] = $role;
// //     }

// //     $movie = new Movie(null, $_POST['titre'], $_POST['realisateur'], $_POST['affiche'], $_POST['annee'], $roles);

// //     $MovieDao::addOne($movie);
// // }
