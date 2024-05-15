<?php

class ActorDao
{

    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM actor');
        $query->execute();
        $movies = array();
        while ($data = $query->fetch()) {
            $actors[] = new Actor($data['id'], $data['title'], $data['director'], $data['poster'], $data['year']);
        }
        return $movies;
    }

    //Récupérer plus d'info sur 1 acteur
    public static function getOne(int $id): Actor
    {
        $query = BDD->prepare('SELECT * FROM actor WHERE id = :id_actor');
        $query->execute(array(':id_actor' => $id));
        $data = $query->fetch();
        return new Actor($data['id'], $data['name'], $data['firstname']);
    }

    public static function addOne(string $character, string $name, string $firstname)
    {
        $query = BDD->prepare('INSERT INTO actor (character, name, firstname) VALUES (:character, :name, :firstname)');
        $query->execute(array(':character' => $character, ':name' => $name, 'firstname' => $firstname));
    }
}
