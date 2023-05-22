<?php

class DBCommettreManager {
    //Method static qui permet de créer une instance de DBManager
    static function PDO(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=boite_a_jurons', 'root', '');
    }

    //Method static qui permet d'inserer une infraction dans la bdd
    static function insertPenalite(Commettre $commettre): bool
    {
        $codeInfraction = $commettre->getCodeInfraction();
        $loginUtilisateur = $commettre->getLoginUtilisateur();
        $loginBalance = $commettre->getLoginBalance();
        $pdo = self::PDO();
        $sql = "INSERT INTO commettre (`code_infraction`, `login_utilisateur`, `login_balance`) 
                    VALUES (?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $codeInfraction);
        $stmt->bindParam(2, $loginUtilisateur);
        $stmt->bindParam(3, $loginBalance);
        return $stmt->execute();
    }

    static function deletePenalite($id): bool
    {

        $pdo = self::PDO();
        $sql = "DELETE FROM `commettre` WHERE id_commettre =?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id);
        return  $stmt->execute();
    }

    static function selectAllPenalitys(): array
    {
        $pdo = self::PDO();
        $sql = "SELECT * FROM commettre ORDER BY date_infraction DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function selectPenalitysByLogin_Balance(string $login_balance): array
    {
        $pdo = self::PDO();
        $sql = "SELECT * FROM commettre WHERE login_balance = ? ORDER BY date_infraction DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $login_balance);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function selectBalance(): array
    {
        $pdo = self::PDO();
        $sql = "SELECT login_balance FROM commettre";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    static function selectBestBalance(): array
    {
        $pdo = self::PDO();
        $sql = "SELECT nom,prenom,COUNT(login_balance) AS total, c.login_balance FROM commettre AS c , utilisateur AS u 
            WHERE  login_balance = u.login_utilisateur GROUP BY login_balance ORDER BY total DESC;";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function selectBestBalanceWeek(): array
    {
        $pdo = self::PDO();
        $sql = "SELECT nom,prenom,COUNT(login_balance) AS total, c.login_balance FROM commettre AS c , utilisateur AS u 
            WHERE  login_balance = u.login_utilisateur AND DATEDIFF(current_timestamp,date_infraction ) <= 7 GROUP BY login_balance ORDER BY total DESC;";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    static function selectCountByCodeInfraction(string $codeInfraction): array
    {
        $pdo = self::PDO();
        $sql = "SELECT nom,prenom,COUNT(code_infraction) AS countInfra, c.login_utilisateur FROM commettre AS c, utilisateur
        AS u WHERE u.login_utilisateur = c.login_utilisateur AND code_infraction = ?  
        AND DATEDIFF(CURRENT_TIMESTAMP,date_infraction) <= 7 GROUP BY login_utilisateur ORDER BY prenom;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $codeInfraction);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static function selectCountTotal(){
        $pdo = self::PDO();
        $sql = "SELECT nom,prenom,COUNT(code_infraction) AS total, c.login_utilisateur FROM commettre AS c, utilisateur
        AS u WHERE u.login_utilisateur = c.login_utilisateur  AND DATEDIFF(CURRENT_TIMESTAMP,date_infraction) <= 7 
        GROUP BY login_utilisateur ORDER BY prenom;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static function totalTarifByLogin() {
        $pdo = self::PDO();
        $sql = "SELECT nom, prenom,c.login_utilisateur, ROUND(SUM(tarif_infraction),2) as totalPrix  FROM commettre AS c , infraction AS i , utilisateur AS u WHERE c.code_infraction = i.code_infraction AND c.login_utilisateur = u.login_utilisateur GROUP BY login_utilisateur";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static function totalTarif() {
        $pdo = self::PDO();
        $sql = "SELECT ROUND(SUM(tarif_infraction),2) as total FROM commettre AS c , infraction AS i , utilisateur AS u WHERE c.code_infraction = i.code_infraction AND c.login_utilisateur = u.login_utilisateur ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);

    }

    static function selectCountByCodeInfractionLogin(string $codeInfraction, string $login): object
    {
        $pdo = self::PDO();
        $sql = "SELECT COUNT(code_infraction) AS countInfra FROM commettre WHERE login_utilisateur= ? AND code_infraction = ?  
        AND DATEDIFF(CURRENT_TIMESTAMP,date_infraction) <= 7;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $codeInfraction);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    static function selectCountTotalByLogin(string $login): object{
        $pdo = self::PDO();
        $sql = "SELECT COUNT(code_infraction) AS total FROM commettre WHERE login_utilisateur= ? 
        AND DATEDIFF(CURRENT_TIMESTAMP,date_infraction) <= 7;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    static function totalTarifForUser(string $login): object {
        $pdo = self::PDO();
        $sql = "SELECT ROUND(SUM(tarif_infraction),2) as total FROM commettre AS c , infraction AS i WHERE c.code_infraction = i.code_infraction AND login_utilisateur =?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);

    }
}

