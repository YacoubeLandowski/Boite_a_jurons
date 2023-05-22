<?php

// On crée la classe Roles
class Roles {
    private int $idRole;
    private string $type;

// On crée la méthode construct qui initialise les attributs de l'objet
    public function __construct (int $idRole,string $type) {
        $this-> idRole = $idRole;
        $this-> type = $type;
    }

    /**
     * Get the value of idRole
     */ 
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set the value of idRole
     *
     * @return  self
     */ 
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}