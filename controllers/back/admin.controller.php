<?php

require "./controllers/back/security.class.php";
require "./models/back/admin.manager.php";

class AdminController{
    private $adminManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
    }

    public function getPageLogin(){
        require_once "views/login.view.php";
    }
    public function connection(){
        if(!empty($_POST['login']) && !empty($_POST['password'])){
            $login = Security::secureHTML($_POST['login']);
            $password = Security::secureHTML($_POST['password']);  
            if($this->adminManager->isConnectionValid($login,$password)){
                $_SESSION['access'] = "admin";
                header('Location: '.URL."back/admin");
            } else {
                header('Location: '.URL."back/login");
            }
        }
    }
    public function getHomepageAdmin(){
        require "views/homepageAdmin.view.php";
    }
}