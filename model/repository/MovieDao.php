<?php

require_once './model/repository/RoleDao.php';
require_once './model/entity/Role.php';

class MovieDao
{

    public static function getAll()
    {
        $query = BDD->prepare('SELECT * FROM movie');
        $query->execute();
        $movies = array();
        while($data = $query->fetch()){
            $roles = RoleDao::getByMovie($data['id']);
            $movies[] = new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
        }
        return $movies;
    }

      //Récupérer plus d'info sur 1 acteur
      public static function getOne(int $id): Movie
      {
          $query = BDD->prepare('SELECT * FROM movie WHERE id = :id_movie');
          $query->execute(array(':id_movie' => $id));
          $data = $query->fetch();
          $roles = RoleDao::getByMovie($data['id']);
          return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
      }
}