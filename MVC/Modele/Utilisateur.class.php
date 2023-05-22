<?php
include_once "../Modele/Personne.class.php";
include_once "../Modele/Roles.class.php";


// on crée la classe Utilisateur héritée de la classe abstraite Personne
class Utilisateur extends Personne {

    private string $login;
    private string $email;
    private string $password;
    private Roles $roles;

// On crée la méthode construct qui initialise les attributs de l'objet, en rappelant les attributs de la classe parent Personne

    public function __construct (string $nom, string $prenom, string $date,
                                 string $login, string $email ,string $password, Roles $roles)
    {
        parent::__construct($nom, $prenom, $date);
        $this-> login = $login;
        $this->email = $email;
        $this-> password = $password;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of roles
     */ 
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set the value of roles
     *
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}