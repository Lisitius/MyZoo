<?php
require_once "models/Model.php";

class APIManager extends Model{
    public function getDBAnimals($idFamily, $idContinent){
        $whereClause = "";
        if($idFamily !== -1 || $idContinent !== -1) $whereClause .= "WHERE ";
        if($idFamily !== -1) $whereClause .= "f.famille_id = :idFamily";
        if($idFamily !== -1 && $idContinent !== -1) $whereClause .=" AND ";
        if($idContinent !== -1) $whereClause .= "c.continent_id = :idContinent";
        
        $req = "SELECT * 
        from animal a inner join famille f on f.famille_id = a.famille_id
        inner join animal_continent ac on ac.animal_id = a.animal_id
        inner join continent c on c.continent_id = ac.continent_id ".$whereClause;
        $stmt = $this->getBdd()->prepare($req);
        if($idFamily !== -1) $stmt->bindValue(":idFamily",$idFamily,PDO::PARAM_INT);
        if($idContinent !== -1) $stmt->bindValue(":idContinent",$idContinent,PDO::PARAM_INT);
        $stmt->execute();
        $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $animals;
    }

    public function getDBAnimal($idAnimal){
        $req = "SELECT * 
        from animal a inner join famille f on f.famille_id = a.famille_id
        inner join animal_continent ac on ac.animal_id = a.animal_id
        inner join continent c on c.continent_id = ac.continent_id
        WHERE a.animal_id = :idAnimal
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":idAnimal",$idAnimal,PDO::PARAM_INT);
        $stmt->execute();
        $lineAnimal = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $lineAnimal;
    }

    public function getDBFamilies(){
        $req = "SELECT * 
        from famille
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $families = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $families;
    }

    public function getDBContinents(){
        $req = "SELECT * 
        from continent
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $continents;
    }
}