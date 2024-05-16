<?php

require_once './model/entity/Role.php';
require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';
require_once './model/repository/MovieDao.php';
require_once './model/repository/ActorDao.php';

class RoleDao
{
    //Récupère tous les rôles
    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM role');
        $query->execute();
        $roles = array();
        while ($data = $query->fetch()) {
            $actor = ActorDao::getOne($data['fk_actor']);
            $roles[] = new Role($data['id'], $data['character'], $actor);
        }
        return $roles;
    }

    //Récupére 1 role
    public static function getOne(int $id): Role
    {
        $query = BDD->prepare('SELECT * FROM role WHERE id = :id_role');
        $query->execute(array(':id_role' => $id));
        $data = $query->fetch();
        $actor = ActorDao::getOne($data['fk_actor']);
        return new Role($data['id'], $data['character'], $actor);
    }

    //Récupère les infos depuis un film
    public static function getByMovie($id)
    {
        $query = BDD->prepare('SELECT * FROM role INNER JOIN movie ON role.fk_movie = movie.id WHERE role.fk_movie = :id_movie');
        $query->execute(array(':id_movie' => $id));
        $roles = array();
        while ($data = $query->fetch()) {
            $actor = ActorDao::getOne($data['fk_actor']);
            $roles[] = new Role($data['id'], $data['character'], $actor);
        }
        return $roles;
    }

    //Récupérer plus d'info sur 1 acteur
    public static function getActor(int $id): ?Actor
    {
        $query = BDD->prepare('SELECT * FROM actor INNER JOIN role ON actor.id = role.fk_actor WHERE role.fk_actor = :id_actor');
        $query->execute(array(';id_actor' => $id));
        $data = $query->fetch();
        if ($data) {
            return new Actor($data['id'], $data['name'], $data['firstname']);
        } else {
            return null;
        }
    }

    //Ajoute un rôle dans la BDD
    public static function addOne(int $fk_movie, int $fk_actor, string $character)
    {
        $query = BDD->prepare('INSERT INTO role (fk_movie, fk_actor, character) VALUES (:fk_movie, :fk_actor, :character)');
        $query->execute(array(':fk_movie' => $fk_movie, ':fk_actor' => $fk_actor, ':character' => $character));
    }
}
