<?php 
require_once './model/repository/connexion.php';

use Model\repository\UserDAO;


echo $twig->render('register.html.twig');

  

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) ){
    $email = $_POST['email']; 
    $password = $_POST['password'];  
    $username = $_POST['username'];
    $hash = hash('sha256',$password);
    echo $twig->render('register.html.twig', ['email'=>$email]);

    $user = UserDao::addOne($username, $email, $hash);
    
    // if ($user) {
    //     // $_SESSION['username'] = $username;
    //     // header('Location: /ecfCinema/home');
    //     // exit();
    // }else {
        
   
} 
