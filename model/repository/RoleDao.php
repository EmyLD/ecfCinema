<?php

namespace Model\repository;


use Model\Entity\Role;
use Model\Entity\Actor;
class RoleDao
{


    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM role');
        $query->execute();
        $roles = array();
        while($data = $query->fetch()){
            $actor = ActorDao::getOne($data['fk_actor']);
            $roles[] = new Role($data['id'], $data['character'], $actor);
        }
        return $roles;
    }

     //Récupérer plus d'info sur 1 role
     public static function getOne(int $id): Role
     {
         $query = BDD->prepare('SELECT * FROM role WHERE id = :id_role');
         $query->execute(array(':id_role' => $id));
         $data = $query->fetch();
         $actor = ActorDao::getOne($data['fk_actor']);
         return new Role($data['id'], $data['character'], $actor);
     }

     public static function getByMovie($id)
     {
         $query = BDD->prepare('SELECT * FROM role INNER JOIN movie ON role.fk_movie = movie.id WHERE role.fk_movie = :id_movie');
         $query->execute(array(':id_movie' => $id));
         $roles = array();
         while($data = $query->fetch()){
             $actor = ActorDao::getOne($data['fk_actor']);
             $roles[] = new Role($data['id'], $data['character'], $actor);
         }
         return $roles;
     }

     //Récupérer plus d'info sur 1 acteur
     public static function getActor(): Actor
     {
         $query = BDD->prepare('SELECT * FROM actor INNER JOIN role ON actor WHERE WHERE role.fk_actor = :id_actor');
         $data = $query->fetch();
         return ActorDao::getOne($data['fk_actor']);;
     }

 
}