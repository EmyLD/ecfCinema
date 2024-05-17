<?php

namespace Model\repository;

use Model\repository\RoleDao;
use Model\entity\Role;
use Model\entity\Movie;

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

    public static function addOne(string $title, int $years, string $poster, string $director)
    {
        $query = BDD->prepare('INSERT INTO movie (title, years, poster, director) VALUES (:title, :years, :poster, :director)');
        $result = $query->execute(array(':title' => $title, ':years' => $years, ':poster' => $poster, ':director' => $director));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //Ajoute 1 film dans la BDD
    public static function createMovie($title, $years, $poster, $director)
    {
        //Ajoute le film dans la BDD
        MovieDao::addOne($title, $years, $poster, $director);
        $idMovie = BDD->lastInsertId();

        //Parcourt chaque rôle dans le tableau
        foreach ($_POST['roles'] as $role) {
            if (empty($role['character']) || empty($role['name']) || empty($role['firstname'])) {
                return "Les informations d'un ou plusieurs rôles sont manquantes";
            }

            //Ajoute l'acteur dans la BDD    
            ActorDao::addOne($role['name'], $role['firstname']);
            $idActor = BDD->lastInsertId();
            //Ajoute le rôle dans la BDD
            RoleDao::addOne($idMovie, $idActor, $role['character']);

            return true;
        }
    }
}