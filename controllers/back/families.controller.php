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
            $idFamily = (int)Security::secureHTML($_POST['famille_id']);

                if($this->familiesManager->countAnimal($idFamily) > 0){
                    $_SESSION['alert'] = [
                        "message" => "La famille n'a pas été supprimé. (Des animaux sont toujours présent dans la famille.)",
                        "type" => "alert-danger"
                    ];
                } else {
                    $this->familiesManager->deleteDBfamily($idFamily);
                    $_SESSION['alert'] = [
                        "message" => "La famille est supprimée",
                        "type" => "alert-success"
                    ];
                }

            header('Location: '.URL.'back/families/visualization');
        
        } else {
            throw new Exception("Vous n'avez pas le droit d'être là ! ");
        }
    }
}