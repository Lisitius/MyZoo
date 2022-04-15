<?php

require_once "models/Model.php";

class FamiliesManager extends Model {
    public function getFamilies(){
        $req = "SELECT * from famille";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $families = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $families;
    }
}