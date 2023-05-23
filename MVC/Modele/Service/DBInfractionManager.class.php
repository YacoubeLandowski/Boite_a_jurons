<?php

class DBInfractionManager {
    //Method static qui permet de créer une instance de DBManager
    static function PDO(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=boite_a_jurons', 'root', '');
    }

    //Method static qui permet d'inserer une infraction dans la bdd
    static function insertInfraction(Infraction $infraction): bool
    {
        $codeInfraction = $infraction->getCodeInfraction();
        $categorie = $infraction->getCategorie();
        $tarif = $infraction->getTarif();
        $pdo = self::PDO();
        $sql = "INSERT INTO infraction (`code_infraction`, `categorie_infraction`, `tarif_infraction`) 
                VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $codeInfraction);
        $stmt->bindParam(2, $categorie);
        $stmt->bindParam(3, $tarif);
        return $stmt->execute();
    }

    //Method static qui permet de mettre a jour une infraction 
    static function updateInfraction(infraction $infraction): bool
    {
        $codeInfraction = $infraction->getCodeInfraction();
        $categorie = $infraction->getCategorie();
        $tarif = $infraction->getTarif();
        $pdo = self::PDO();
        $sql = "UPDATE `infraction` SET `code_infraction` =?, `categorie_infraction` =?, `tarif_infraction` =? WHERE code_infraction =$codeInfraction";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $codeInfraction);
        $stmt->bindParam(2, $categorie);
        $stmt->bindParam(3, $tarif);
        return  $stmt->execute();
    }
    // Methode static qui permet de supprimer une infraction de la bdd

    static function deleteInfraction(string $codeInfraction): bool
    {

        $pdo = self::PDO();
        $sql = "DELETE FROM infraction WHERE code_infraction =?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $codeInfraction);
        return  $stmt->execute();
    }

        //Method static qui permet de selectionner les infractions de la bdd
        static function selectInfraction(): array
        {
            $pdo = self::PDO();
            $sql = "SELECT * FROM infraction";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    //Method static qui permet de selectionner les infractions de la bdd par code 
        static function selectInfractionBycode(string $codeInfraction): object
        {
            $pdo = self::PDO();
            $sql = "SELECT * FROM infraction where code_infraction=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $codeInfraction);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
            }
}