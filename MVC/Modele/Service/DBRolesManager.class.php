<?php

class DBRolesManager {
    //Method static qui permet de créer une instance de DBManager
    static function PDO(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=boite_a_jurons', 'root', '');
    }


    //Method static qui permet d'inserer un role dans la bdd
    static function insertRoles(string $type): bool
    {
        $pdo = self::PDO();
        $sql = "INSERT INTO roles (type_roles) values (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $type);
        return $stmt->execute();
    }

    //Method static qui permet de select roles a partir de la bdd
    static function selectRoles(): array
    {
        $pdo = self::PDO();
        $sql = "SELECT * FROM roles";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static function selectRolesByType(int $id): object{
        $pdo = self::PDO();
        $sql = "SELECT * FROM roles WHERE id_roles =?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    //Method static qui permet d' uptdate un role dans la bdd
    static function updateRoles(string $newType, string $oldType): bool
    {
        $pdo = self::PDO();
        $sql = "UPDATE roles SET type_roles = ? WHERE type_roles= ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $newType);
        $stmt->bindParam(2, $oldType);
        return $stmt->execute();
    }


    //Method static qui permet de supprimer un roles dans la bdd
    static function deleteRoles(string $type): bool
    {
        $pdo = self::PDO();
        $sql = "DELETE FROM roles WHERE type_roles = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $type);
        return $stmt->execute();
    }
}