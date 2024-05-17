<?php


$session = null;

if(isset($_SESSION['username'])){
    $session = $_SESSION['username'];
}

echo $twig->render('header.html.twig', ['session' => $session]);
