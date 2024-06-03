<?php


$session = null;

if(isset($_SESSION['username'])){
    $session = $_SESSION['username'];
} else {
    $session = null;
}

echo $twig->render('header.html.twig', ['session' => $session]);
