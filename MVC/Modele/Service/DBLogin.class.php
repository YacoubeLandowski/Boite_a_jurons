<?php


class DBLogin
{
    //Method static qui permet de créer une instance de DBManager
    static function PDO(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=boite_a_jurons', 'root', '');
    }

    static function authentification(string $login, string $password){
        $connect = self::PDO ();
        $query = "SELECT * FROM `utilisateur` WHERE login_utilisateur='$login'";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        $user =  $stmt->fetch(PDO::FETCH_OBJ);
        if ($user === false) {
            return false;
        }else {
            return password_verify($password, $user->password);
        }
    }
}

?>