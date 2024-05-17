<?php

class ActorDao
{
    //Récupère tous les acteurs
    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM actor');
        $query->execute();
        $actors = array();
        while ($data = $query->fetch()) {
            $actors[] = new Actor($data['id'], $data['name'], $data['firstname']);
        }
        return $actors;
    }

    //Récupére 1 acteur
    public static function getOne(int $id): ?Actor
    {
        $query = BDD->prepare('SELECT * FROM actor WHERE id = :id_actor');
        $query->execute(array(':id_actor' => $id));
        $data = $query->fetch();
        if ($data) {
            return new Actor($data['id'], $data['name'], $data['firstname']);
        } else {
            return null;
        }
    }

    //Ajoute 1 acteur
    public static function addOne(string $name, string $firstname)
    {
        $query = BDD->prepare('INSERT INTO actor (name, firstname) VALUES (:name, :firstname)');
        $result = $query->execute(array(':name' => $name, ':firstname' => $firstname));
        if ($result) {
            return array("status" => "success", "message" => "Nouveau film bien enregistré");
        } else {
            return array ("status" => "error", "message" => "Erreur".implode(",".$query->errorInfo()));
        }
    }
}
