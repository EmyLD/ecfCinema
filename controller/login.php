<?php


use Model\repository\UserDao;

$UserDao = new UserDao();

if(empty($_SESSION['username'])) {
    $template = $twig->load('login.html.twig');
    echo $twig->render($template);
   
} else {
    header('Location: home');
}



if(isset($_POST['email']) && isset($_POST['password'])) {
    try {
        
        $hashed = password_hash( $_POST['password'], PASSWORD_BCRYPT);
        $user = $UserDao->findOne($_POST["email"], $hashed);
      
        if ($user) {
            $_SESSION['username'] =  $user;
            header('Location: home');
            exit();
        }elseif(empty($user)){
            $error = 'Identifiant ou mot de passe incorrect';
            echo $template->renderBlock('error',  [ 'type' => $error]);
        } 
        
    } catch (Exception $e) {
        die ('Error : ' . $e->getMessage());
    }
    
}

