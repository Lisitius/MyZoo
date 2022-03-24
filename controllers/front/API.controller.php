<?php
require_once "models/front/API.manager.php";
require_once "models/Model.php";

class APIController {
    private $apiManager;

    public function __construct(){
       $this->apiManager = new APIManager(); 
    }

    public function getAnimals(){
        $animals = $this->apiManager->getDBAnimals();
        Model::sendJSON($this->formatDataLinesAnimals($animals));
    }
    
    public function getAnimal($idAnimal){
        $lineAnimal = $this->apiManager->getDBAnimal($idAnimal);
        Model::sendJSON($this->formatDataLinesAnimals($lineAnimal));
    }

    private function formatDataLinesAnimals($lines){
        $tab = [];
        foreach($lines as $line){
            if(!array_key_exists($line['animal_id'],$tab)){
                $tab[$line['animal_id']] = [
                    "id" => $line['animal_id'],
                    "name" => $line['animal_nom'],
                    "description" => $line['animal_description'],
                    "image" => $line['animal_image'],
                    "famille" => [
                        "idFamily" => $line['famille_id'],
                        "wordingFamily" => $line['famille_libelle'],
                        "descriptionFamily" => $line['famille_description']
                    ]
                ];
            }
            $tab[$line['animal_id']]['continents'][] = [
                "idContinent" => $line['continent_id'],
                "wordingContinent" => $line['continent_libelle']
            ];
        }
        return $tab;
    }

    public function getContinents(){
        $continents = $this->apiManager->getDBContinents();
        Model::sendJSON($continents);
    }
    
    public function getFamilies(){
        $families = $this->apiManager->getDBFamilies();
        Model::sendJSON($families);
    }
}