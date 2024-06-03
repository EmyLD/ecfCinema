<?php
// require_once './model/repository/connexion.php';



use Model\repository\MovieDao;

$movieDao = new MovieDao();

$movies = $movieDao->getAll();
if(isset($_POST['search'])){
    $movies = $movieDao->getAll($_POST['search']);
}else {
    $movies = $movieDao->getAll();
}


echo $twig->render('home.html.twig',
['movies' => $movies
]
);

