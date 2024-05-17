<?php


require_once './model/repository/connexion.php';

use Model\repository\UserDAO;

echo $twig->render('login.html.twig');


if(isset($_POST['email']) && isset($_POST['password'])) {
    try {
        $hash = hash('sha256', $_POST['password']);
        $user = UserDao::findOne($_POST["email"], $hash);
      
        if ($user) {
            $_SESSION['username'] = $user->getUsername();
            header('Location: /ecfCinema/home');
            exit();
        }elseif($user == "not good"){
            $error = 'Identifiant ou mot de passe incorrect';
            echo $twig->render('login.html.twig', ['error' => $error]);
        } 
        
    } catch (Exception $e) {
        die ('Error : ' . $e->getMessage());
    }
    
}

