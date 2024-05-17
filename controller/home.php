<?php
require_once './model/repository/connexion.php';
require_once './model/repository/MovieDao.php';
require_once './model/repository/ActorDao.php';
require_once './model/repository/RoleDao.php';

require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';
require_once './model/entity/Role.php';

$movies =  new MovieDao;
$roles = new RoleDao;

$session = null;

if(isset($_SESSION['username'])){
    $session = $_SESSION['username'];
}

echo $twig->render('home.html.twig',
['movies' => $movies,
'roles' => $roles,
'session' => $session
]
);