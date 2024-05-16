<?php

require_once './model/entity/Role.php';
require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';

class RoleDao
{

    //Récupère tous les rôles
    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM role');
        $query->execute();
        $roles = array();
        while($data = $query->fetch()){
            $roles[] = new Role($data['id'], $data['fk_movie'], $data['fk_actor'], $data['character']);
        }
        return $roles;
    }

     //Récupére 1 rôle
     public static function getOne(int $id): Role
     {
         $query = BDD->prepare('SELECT * FROM role WHERE id = :id_role');
         $query->execute(array(':id_role' => $id));
         $data = $query->fetch();
         return new Role($data['id'], $data['fk_movie'], $data['fk_actor'], $data['character']);
     }

     //Récupère le/les rôles d'un film
     public static function getRoleMovie(int $id, $fk_movie): Role
     {
         $query = BDD->prepare('SELECT * FROM role INNER JOIN movie ON role.fk_movie = movie.id WHERE role.id = :id_role AND movie:id = :fk_movie');
         $query->execute(array(':id_role' => $id, ':fk_movie' => $fk_movie));
         $data = $query->fetch();
         return new Role($data['id'], $data['fk_movie'], $data['fk_actor'], $data['character']);
     }

     //Ajoute un rôle dans la BDD
    public static function addOne(int $fk_movie, int $fk_actor, string $character)
    {
       $query = BDD->prepare('INSERT INTO role (fk_movie, fk__actor, character) VALUES (:fk_movie, :fk_actor, :character)');
       $query->execute(array(':fk_movie' => $fk_movie, ':fk_actor' => $fk_actor, ':character' => $character));
    }
}