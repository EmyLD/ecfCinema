<?php

namespace Model\repository;

use Model\repository\RoleDao;
use Model\entity\Movie;
use Model\repository\Dao;
use Exception;

class MovieDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll($search = "")
    {
        $query = $this->pdo->prepare('SELECT * FROM movie WHERE movie.title like :search');
        $search = '%' . $search . '%';
        $query->execute(array(':search' => $search));
        $movies = array();
        while ($data = $query->fetch()) {
            $roles = RoleDao::getByMovie($data['id']);
            $movies[] = new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['year'], $roles);
        }
        return $movies;
    }

    public function getOne(int $id): Movie
    {
        $query = $this->pdo->prepare('SELECT * FROM movie WHERE id = :id_movie');
        $query->execute(array(':id_movie' => $id));
        $data = $query->fetch();
        $roles = RoleDao::getByMovie($data['id']);
        return new Movie($data['id'], $data['title'], $data['director'], $data['poster'], $data['years'], $roles);
    }

    public function addOne($movie)
    {
        try {
            $query = $this->pdo->prepare('INSERT INTO movie (title, year, poster, director) VALUES (:title, :year, :poster, :director)');
            $result = $query->execute(array(
                ':title' => $movie->getTitle(),
                ':year' => $movie->getYear(),
                ':poster' => $movie->getPoster(),
                ':director' => $movie->getDirector()
            ));
    
            if (!$result) {
                return array('status' => false, 'message' => 'Erreur lors de l\'ajout du film.');
            }
    
            $idMovie = $this->pdo->lastInsertId();
    
            foreach ($movie->getRoles() as $role) {
                $actor = $role->getActor();
                $actorAdded = ActorDao::addOne($actor->getName(), $actor->getFirstname());
    
                if (!$actorAdded) {
                    return array('status' => false, 'message' => 'Erreur lors de l\'ajout de l\'acteur.');
                }
    
                $idActor = $this->pdo->lastInsertId();
                $roleAdded = RoleDao::addOne($idMovie, $idActor, $role->getCharacter());
    
                if (!$roleAdded) {
                    return array('status' => false, 'message' => 'Erreur lors de l\'ajout du rôle.');
                }
            }
    
            return array('status' => true, 'message' => 'Film, acteurs et rôles ajoutés avec succès !');
    
        } catch (Exception $e) {
            return array('status' => false, 'message' => 'Erreur: ' . $e->getMessage());
        }
    }
}
?>
