<?php
// Initialisation de la session


session_start();

require_once  '../vendor/autoload.php';



$loader = new \Twig\Loader\FilesystemLoader('view');
$twig = new \Twig\Environment($loader);


$twig->addGlobal('session', $_SESSION);
