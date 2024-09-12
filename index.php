<?php
// start session 
session_start();

$path = $_SERVER['REQUEST_URI']; 

//remove all the query string from the URL
$path = parse_url ($path, PHP_URL_PATH);


// to get the functions working on index (importing functions page)
require "includes/functions.php";


switch ($path) {
  // pages
  case '/dashboard':
    require 'pages/dashboard.php';
    break;
  case '/login':
    require 'pages/login.php';
    break;
  case '/manage-posts-add':
    require 'pages/manage-posts-add.php';
    break;
  case '/manage-posts-edit':
    require 'pages/manage-posts-edit.php';
    break;
  case '/manage-posts':
    require 'pages/manage-posts.php';
    break;
  case '/manage-users-add':
    require 'pages/manage-users-add.php';
    break;
  case '/manage-users-change' :
    require 'pages/manage-users-change.php';
    break;
  case '/manage-users-edit' :
    require 'pages/manage-users-edit.php';
    break;
  case '/manage-users-changepwd' :
    require 'pages/manage-users-changepwd.php';
    break;
  case '/manage-users' :
    require 'pages/manage-users.php';
    break;
  case '/post' :
    require 'pages/post.php';
    break;
  case '/signup' :
    require 'pages/signup.php';
    break;

  // functionality pages (pages that won't be shown and are purely used for functionality purposes)
  case '/auth/login':
    require 'includes/auth/login.php';
    break;
  case '/auth/signup':
    require 'includes/auth/signup.php';
    break;
  case '/auth/logout':
    require 'includes/auth/logout.php';
    break;
  case '/user/add':
    require 'includes/user/add.php';
    break;
  case '/user/delete':
    require 'includes/user/delete.php';
    break;
  case '/user/edit':
    require 'includes/user/edit.php';
    break;
  case '/user/changepwd':
    require 'includes/user/changepwd.php';
    break;
  case '/post/add':
    require 'includes/post/add.php';
    break;
  case '/post/delete':
    require 'includes/post/delete.php';
    break;
  case '/post/edit':
    require 'includes/post/edit.php';
    break;

  // defaults to home if path cannot be found
  default:
    require 'pages/home.php';
    break;
}