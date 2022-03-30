<?php
// Router
session_start();

require_once './controller/HomeController.php';
require_once './controller/UserController.php';
require_once './controller/ProductController.php';

$url = isset($_GET['url']) ? $_GET['url'] : "home"; 

function searchHtml($filename){
        return file_get_contents('./templates/'. $filename . '.html');
    }
    
switch($url){
    // Route index.php?url=home
    case "home" : 
        $homeController = new HomeController();
        $homeController->home();
        break;
        
     case "login":
        $userController = new UserController();
        $userController->login();
        break;

    case "loginSecurity":
        $userController = new UserController();
        $userController->loginSecurity();
        break;
    
    case "registerSecurity":
        $userController = new UserController();
        $userController->registerSecurity();
        break;
    
    case "register":
        $userController = new UserController();
        $userController->register();
        break;
    
    case "account":
        $userController = new UserController();
        $userController->account();
        break;
        
    case "logout":
        $userController = new UserController();
        $userController->logout();
        break;        
    
    case "shop":
        $homeController = new homeController();
        $homeController->shop();
        break;
        
    case "instruments":
        $productController = new ProductController();
        $productController->shop();
        break;
        
    case "basket":
        $page = searchHtml('panier');
        echo($page);
        break;
}


