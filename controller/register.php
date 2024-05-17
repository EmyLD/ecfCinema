<?php 
require_once './model/repository/connexion.php';

use Model\repository\UserDAO;


echo $twig->render('register.html.twig');

  

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) ){
    try {
        $hash = hash('sha256',$_POST['password']);
        $isAdded = UserDao::addOne($_POST['username'], $_POST['email'], $hash);
        
        if ($isAdded) {
            $_SESSION['username'] = $username;
            header('Location: /ecfCinema/home');
            exit();
        } else {
            echo $twig->render('register.html.twig', ['error' => $error]);
        } 
    } catch (Exception $e) {
        die ('Error : ' . $e->getMessage());
    }
   
}
