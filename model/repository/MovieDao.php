<?php
namespace Model\repository;
use Model\Entity\Movie;
class MovieDao
{

    public static function getAll($search = "")
    {
        $query = BDD->prepare('SELECT * FROM movie WHERE movie.title like :search');
        $search = '%' . $search . '%';
        $query->execute(array(':search' => $search));
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