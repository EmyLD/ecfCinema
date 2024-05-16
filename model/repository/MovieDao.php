<?php

require_once './model/repository/RoleDao.php';
require_once './model/entity/Role.php';

class MovieDao
{

    //Récupère tous les films
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

      //Récupére 1 film
      public static function getOne(int $id): Movie
      {
          $query = BDD->prepare('SELECT * FROM movie WHERE id = :id_movie');
          $query->execute(array(':id_movie' => $id));
          $data = $query->fetch();
          $roles = RoleDao::getByMovie($data['id']);
          return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
      }

      //Ajoute 1 film dans la BDD
      public static function createMovie($postData)
      {
          if (empty($postData['title']) || empty($postData['year']) || empty($postData['poster']) || empty($postData['director']) || empty($postData['name']) || empty($postData['firstname'])) 
          {
              return false;
          }
  
          $movie = new Movie($_POST['title'], $_POST['year'], $_POST['poster'], $_POST['director'], $role);
          $actor = new Actor($_POST['name'], $_POST['firstname']);
          $role = new Role($actor);
  
          MovieDao::addOne($movie->getTitle(), $movie->getYear(), $movie->getPoster(), $movie->getDirector());
          ActorDao::addOne($actor->getName(), $actor->getFirstname());
          RoleDao::addOne(MovieDao::getOne());
  
          return true;
      }
}