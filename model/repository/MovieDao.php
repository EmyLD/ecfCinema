<?php

class MovieDao
{

    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM movie');
        $query->execute();
        $movies = array();
        while ($data = $query->fetch()) {
            $movies[] = new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'],  $data['roles']);
        }
        return $movies;
    }

    //Récupérer plus d'info sur 1 acteur
    public static function getOne(int $id): Movie
    {
        $query = BDD->prepare('SELECT * FROM movie WHERE id = :id_movie');
        $query->execute(array(':id_movie' => $id));
        $data = $query->fetch();
        return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $data['roles']);
    }

    public static function addOne(string $title, int $year, string $poster, string $director)
    {
        $query = BDD->prepare('INSERT INTO movie (title, year, poster, director) VALUES (:title, :year, :poster, :director)');
        $query->execute(array(':title' => $title, ':year' => $year, ':poster' => $poster, ':director' => $director));
    }

    public static function createMovie($postData)
    {
        if (empty($postData['title']) || empty($postData['year']) || empty($postData['poster']) || empty($postData['director']) || empty($postData['name']) || empty($postData['firstname'])) 
        {
            return false;
        }

        $movie = new Movie($_POST['title'], $_POST['year'], $_POST['poster'], $_POST['director'], $role);
        $actor = new Actor($_POST['name'], $_POST['firstname']);
        $role = new Role($actor);

        MovieDao::addOne($movie->getTitle(), $movie->getYear(), $movie->getPoster(), $movie->getDirector());
        ActorDao::addOne($actor->getName(), $actor->getFirstname());
        RoleDao::addOne(MovieDao::getOne());

        return true;
    }
}
