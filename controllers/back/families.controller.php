<?php

require_once "./controllers/back/security.class.php";
require_once "./models/back/families.manager.php";

class FamiliesController{
    private $familiesManager;

    public function __construct(){
        $this->familiesManager = new FamiliesManager();
    }

    public function visualization(){
        if(Security::verifAccessSession()){
            $families = $this->familiesManager->getFamilies();
            require_once "views/familiesVisualization.view.php";
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }

    public function delete(){
        if(Security::verifAccessSession()){
            $this->familiesManager->deleteDBfamily((int)Security::secureHTML($_POST['famille_id']));
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }
}