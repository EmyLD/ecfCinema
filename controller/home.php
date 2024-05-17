<?php

require_once './model/repository/MovieDao.php';
require_once './model/repository/ActorDao.php';
require_once './model/repository/RoleDao.php';

require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';
require_once './model/entity/Role.php';

use Model\repository\MovieDao;
use Model\repository\RoleDao;

$movies =  new MovieDao;
$roles = new RoleDao;


echo $twig->render('home.html.twig',
['movies' => $movies,
'roles' => $roles,

]
);