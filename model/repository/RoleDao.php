<?php

namespace Model\repository;

use Model\entity\Role;
use Model\entity\Actor;
use Model\repository\ActorDao;
use Model\repository\Dao;

class RoleDao extends Dao
{
    //Récupère tous les rôles
    public function getAll()
    {
        $ActorDao = new ActorDao();
        $query = $this->pdo->prepare('SELECT * FROM role');
        $query->execute();
        $roles = array();
        while ($data = $query->fetch()) {
            $actor = $ActorDao->getOne($data['fk_actor']);
            $roles[] = new Role($data['id'], $data['character'], $actor);
        }
        return $roles;
    }

    //Récupére 1 role
    public function getOne(int $id): Role
    {
        $ActorDao = new ActorDao();
        $query = $this->pdo->prepare('SELECT * FROM role WHERE id = :id_role');
        $query->execute(array(':id_role' => $id));
        $data = $query->fetch();
        $actor = $ActorDao->getOne($data['fk_actor']);
        return new Role($data['id'], $data['character'], $actor);
    }

    //Récupère les infos depuis un film
    public function getByMovie($id)
    {
        $ActorDao = new ActorDao();
        $query = $this->pdo->prepare('SELECT * FROM role INNER JOIN movie ON role.fk_movie = movie.id WHERE role.fk_movie = :id_movie');
        $query->execute(array(':id_movie' => $id));
        $roles = array();
        while ($data = $query->fetch()) {
            $actor = $ActorDao->getOne($data['fk_actor']);
            $roles[] = new Role($data['id'], $data['character'], $actor);
        }
        return $roles;
    }

    //Récupérer plus d'info sur 1 acteur
    public function getActor(int $id): ?Actor
    {
        $query = $this->pdo->prepare('SELECT * FROM actor INNER JOIN role ON actor.id = role.fk_actor WHERE role.fk_actor = :id_actor');
        $query->execute(array(';id_actor' => $id));
        $data = $query->fetch();
        if ($data) {
            return new Actor($data['id'], $data['name'], $data['firstname']);
        } else {
            return null;
        }
    }

    //Ajoute un rôle dans la BDD
    public function addOne(int $fk_movie, int $fk_actor, string $character)
    {
        $query = $this->pdo->prepare('INSERT INTO role (fk_movie, fk_actor, `character`) VALUES (:fk_movie, :fk_actor, :character)');
        $result = $query->execute(array(':fk_movie' => $fk_movie, ':fk_actor' => $fk_actor, ':character' => $character));

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
