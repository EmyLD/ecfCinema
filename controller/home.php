<?php
require_once './model/repository/connexion.php';



use Model\repository\MovieDao;

$movies = MovieDao::getAll();
if(isset($_POST['search'])){
    $movies = MovieDao::getAll($_POST['search']);
}else {
    $movies = MovieDao::getAll();
}


echo $twig->render('home.html.twig',
['movies' => $movies
]
);

