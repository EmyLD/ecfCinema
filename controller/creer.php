<?php

require_once './model/repository/connexion.php';
require_once './model/repository/MovieDao.php';
require_once './model/repository/ActorDao.php';
require_once './model/repository/RoleDao.php';

require_once './model/entity/Movie.php';
require_once './model/entity/Actor.php';
require_once './model/entity/Role.php';

echo $twig->render('creer.html.twig', ['erreur' => 404]);

if (isset($_POST['title'], $_POST['year'], $_POST['poster'], $_POST['director'])) {
    echo "ya";
} else if (!isset($_POST['title']) || !isset($_POST['year']) || !isset($_POST['poster']) || !isset($_POST['director'])) {
    echo "yapa";
}