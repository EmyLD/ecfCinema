<?php

echo $twig->render('home.html.twig', ['session' => $_SESSION['username']]);
