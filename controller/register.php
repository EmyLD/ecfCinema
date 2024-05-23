<?php 
require_once './model/repository/connexion.php';

use Model\repository\UserDao;


if(empty($_SESSION['username'])) {
    $template = $twig->load('register.html.twig');
    echo $twig->render($template);
   
} else {
    header('Location: home');
}
  
if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['confirmPassword'])){
    $patternUsername =  '/^[a-zA-Z0-9]*$/';
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $username = preg_match($patternUsername, $_POST['username']);   
    try {
        if($email && $username === 1 && $_POST['password'] == $_POST['confirmPassword']) {
            $hashed = password_hash( $_POST['password'], PASSWORD_BCRYPT);
            $cleanUsername = htmlspecialchars($_POST['username']);
            $capUsername= ucfirst($cleanUsername);
            $isAdded = UserDao::addOne($capUsername, $_POST['email'], $hashed);
            
            if ($isAdded) {
                $_SESSION['username'] = $capUsername;
                header('Location: home.php');
                exit();
            } else {
                echo $template->renderBlock('error',  [ 'type' => "Merci de bien vouloir vérifier les champs."]);
            } 
        } else if($_POST['password'] != $_POST['confirmPassword']) {
            echo $template->renderBlock('error',  [ 'type' => ' Les mots de passe doivent être identiques.']);
        }
        
    } catch (Exception $e) {
        die ('Error : ' . $e->getMessage());
    }
   
}
