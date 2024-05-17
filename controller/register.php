<?php 
require_once './model/repository/connexion.php';

use Model\repository\UserDAO;


echo $twig->render('register.html.twig');

  
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) ){
    $patternUsername =  '/^[a-zA-Z]{3,20}$/';
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $username = preg_match($patternUsername, $_POST['username']);   
    try {
        if($email && $username === 1) {
            $hash = hash('sha256',$_POST['password']);
            $cleanUsername = htmlspecialchars($_POST['username']);
            $capUsername= ucfirst($cleanUsername);
            $isAdded = UserDao::addOne($capUsername, $_POST['email'], $hash);
            
            if ($isAdded) {
                $_SESSION['username'] = $capUsername;
                header('Location: /ecfCinema/login');
                exit();
            } else {
                echo $twig->render('register.html.twig', ['error' => $error]);
            } 
        } else {
            null;
        }
        
    } catch (Exception $e) {
        die ('Error : ' . $e->getMessage());
    }
   
}
