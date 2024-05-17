<?php

session_unset();
if(session_unset()) {
    echo $twig->render('login.html.twig');
}


