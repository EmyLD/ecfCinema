<?php

require_once './model/repository/RoleDao.php';
require_once './model/entity/Role.php';

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
            $movies[] = new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
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
        return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
    }

    public static function addOne(string $title, int $year, string $poster, string $director)
    {
        $query = BDD->prepare('INSERT INTO movie (title, year, poster, director) VALUES (:title, :year, :poster, :director)');
        $query->execute(array(':title' => $title, ':year' => $year, ':poster' => $poster, ':director' => $director));
    }

    //Ajoute 1 film dans la BDD
    public static function createMovie($postData)
    {
        if (empty($postData['title']) || empty($postData['year']) || empty($postData['poster']) || empty($postData['director']) || empty($postData['character']) || empty($postData['name']) || empty($postData['firstname'])) {
            return false;
        }

        // $actor = new Actor($postData['name'], $postData['firstname']);
        // $role = new Role($postData['character'], $postData['actor']);
        // $movie = new Movie($postData['title'], $postData['year'], $postData['poster'], $postData['director'], $role);

        MovieDao::addOne($postData['title'], $postData['year'], $postData['poster'], $postData['director']);
        $idMovie = BDD->lastInsertId();
        ActorDao::addOne($postData['name'], $postData['firstname']);
        $idActor = BDD->lastInsertId();
        RoleDao::addOne($idMovie, $idActor, $postData['character']);

        return true;
    }
}
