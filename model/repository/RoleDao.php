<?php

require_once './model/entity/Role.php';
require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';

class RoleDao
{


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

     //Récupérer plus d'info sur 1 acteur
     public static function getOne(int $id): Role
     {
         $query = BDD->prepare('SELECT * FROM role WHERE id = :id_role');
         $query->execute(array(':id_role' => $id));
         $data = $query->fetch();
         return new Role($data['id'], $data['fk_movie'], $data['fk_actor'], $data['character']);
     }

     public static function getRoleMovie(int $id, $fk_movie): Role
     {
         $query = BDD->prepare('SELECT * FROM role INNER JOIN movie ON role.fk_movie = movie.id WHERE id = :id_role' );
         $query->execute(array(':id_role' => $id, ':fk_movie' => $fk_movie));
         $data = $query->fetch();
         return new Role($data['id'], $data['fk_movie'], $data['fk_actor'], $data['character']);
     }


     

    // public static function addOne($data): bool
    // {
       
    // }

}