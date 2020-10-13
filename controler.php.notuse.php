<?php

/**
 * This is an example of a front controller for a flat file PHP site. Using a
 * Static list provides security against URL injection by default. See README.md
 * for more examples.
 */
# [START gae_simple_front_controller]
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':
        session_start();
        if(!isset($_SESSION['UserData']['Username'])){
            header("location:login.php");
            exit;
            }
        break;
    case '/login.php':
        require 'login.php';
        break;
    case '/ceklogin.php':
        require 'ceklogin.php';
        break;
    case '/index.php':
        session_start();
        if(!isset($_SESSION['UserData']['Username'])){
            header("location:login.php");
            exit;
            }
        break;
}