<?php


namespace Model\repository;
use Model\repository\Dao;
use Model\entity\Actor;

class ActorDao extends Dao
{
    //Récupère tous les acteurs
    public function getAll(): array
    {
        $query = $this->pdo->prepare('SELECT * FROM actor');
        $query->execute();
        $actors = array();
        while ($data = $query->fetch()) {
            $actors[] = new Actor($data['id'], $data['name'], $data['firstname']);
        }
        return $actors;
    }

    //Récupére 1 acteur
    public function getOne(int $id): Actor
    {
        $query = $this->pdo->prepare('SELECT * FROM actor WHERE id = :id_actor');
        $query->execute(array(':id_actor' => $id));
        $data = $query->fetch();
        if ($data) {
            return new Actor($data['id'], $data['name'], $data['firstname']);
        } else {
            return null;
        }
    }

    //Vérifie si un acteur existe déjà
    public function actorExists(string $name, string $firstname): ?Actor
    {
        $query = $this->pdo->prepare('SELECT * FROM actor WHERE name = :name AND firstname = :firstname');
        $query->execute(array(':name' => $name, ':firstname' => $firstname));
        $data = $query->fetch();
        if ($data) {
            return new Actor($data['id'], $data['name'], $data['firstname']);
        } else {
            return null;
        }
    }

    //Ajoute 1 acteur
    public function addOne(string $name, string $firstname): bool
    {
        $query = $this->pdo->prepare('INSERT INTO actor (name, firstname) VALUES (:name, :firstname)');
        if (self::actorExists($name, $firstname)) {
            return false; // L'acteur existe déjà
        }

        $query = $this->pdo->prepare('INSERT INTO actor (name, firstname) VALUES (:name, :firstname)');
        $result = $query->execute(array(':name' => $name, ':firstname' => $firstname));

        return $result ? true : false;
    }
}
