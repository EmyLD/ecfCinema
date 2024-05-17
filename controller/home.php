<?php
require_once './model/repository/connexion.php';


use Model\repository\RoleDao;
use Model\repository\MovieDao;

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