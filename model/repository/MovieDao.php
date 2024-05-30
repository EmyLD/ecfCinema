<?php

namespace Model\repository;

use Model\repository\RoleDao;
use Model\entity\Role;
use Model\entity\Movie;
use Model\repository\connexion;
use Exception;

class MovieDao
{

    //Récupère tous les films
    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM movie');
        $query->execute();
        $movies = array();
        while ($data = $query->fetch()) {
            $roles = RoleDao::getByMovie($data['id']);
            $movies[] = new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['years'], $roles);
        }
        return $movies;
    }

    //Récupére 1 film
    public static function getOne(int $id): Movie
    {
        $query = BDD->prepare('SELECT * FROM movie WHERE id = :id_movie');
        $query->execute(array(':id_movie' => $id));
        $data = $query->fetch();
        $roles = RoleDao::getByMovie($data['id']);
        return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['years'], $roles);
    }

    public static function addOne($movie)
    {
        try {
            $query = BDD->prepare('INSERT INTO movie (title, year, poster, director) VALUES (:title, :year, :poster, :director)');
            $result = $query->execute(array(
                ':title' => $movie->getTitle(),
                ':year' => $movie->getYear(),
                ':poster' => $movie->getPoster(),
                ':director' => $movie->getDirector()
            ));
    
            if (!$result) {
                return array('status' => false, 'message' => 'Erreur lors de l\'ajout du film.');
            }
    
            $idMovie = BDD->lastInsertId();
    
            foreach ($movie->getRoles() as $role) {
                $actor = $role->getActor();
                $actorAdded = ActorDao::addOne($actor->getName(), $actor->getFirstname());
    
                if (!$actorAdded) {
                    return array('status' => false, 'message' => 'Erreur lors de l\'ajout de l\'acteur.');
                }
    
                $idActor = BDD->lastInsertId();
                $roleAdded = RoleDao::addOne($idMovie, $idActor, $role->getCharacter());
    
                if (!$roleAdded) {
                    return array('status' => false, 'message' => 'Erreur lors de l\'ajout du rôle.');
                }
            }
    
            return array('status' => true, 'message' => 'Film, acteurs et rôles ajoutés avec succès !');
    
        } catch (Exception $e) {
            return array('status' => false, 'message' => 'Erreur: ' . $e->getMessage());
        }
    }

//     //Ajoute 1 film dans la BDD
//     public static function createMovie($title, $years, $poster, $director)
//     {
//         //Ajoute le film dans la BDD
//         MovieDao::addOne($title, $years, $poster, $director);
//         $idMovie = BDD->lastInsertId();

//         //Parcourt chaque rôle dans le tableau
//         foreach ($_POST['roles'] as $role) {
//             if (empty($role['character']) || empty($role['name']) || empty($role['firstname'])) {
//                 return "Les informations d'un ou plusieurs rôles sont manquantes";
//             }

//             //Ajoute l'acteur dans la BDD    
//             ActorDao::addOne($role['name'], $role['firstname']);
//             $idActor = BDD->lastInsertId();
//             //Ajoute le rôle dans la BDD
//             RoleDao::addOne($idMovie, $idActor, $role['character']);

//             return true;
//         }
//     }
}