<?php

unset($_SESSION['username']);
echo $twig->render('login.html.twig');

