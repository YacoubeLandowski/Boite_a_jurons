<?php

// On crée la classe Commettre
class Commettre {

    private string $codeInfraction; 

    private string $loginUtilisateur;

    private string $loginBalance;

// On crée la méthode construct qui initialise les attributs de l'objet
    public function __construct (string $codeInfraction, string $loginUtilisateur, string $loginBalance) {
        $this->codeInfraction = $codeInfraction;
        $this->loginUtilisateur = $loginUtilisateur;
        $this->loginBalance = $loginBalance;
    }




    /**
     * Get the value of codeInfraction
     */ 
    public function getCodeInfraction()
    {
        return $this->codeInfraction;
    }

    /**
     * Set the value of codeInfraction
     *
     * @return  self
     */ 
    public function setCodeInfraction($codeInfraction)
    {
        $this->codeInfraction = $codeInfraction;

        return $this;
    }

    /**
     * Get the value of loginUtilisateur
     */ 
    public function getLoginUtilisateur()
    {
        return $this->loginUtilisateur;
    }

    /**
     * Set the value of loginUtilisateur
     *
     * @return  self
     */ 
    public function setLoginUtilisateur($loginUtilisateur)
    {
        $this->loginUtilisateur = $loginUtilisateur;

        return $this;
    }

    /**
     * Get the value of loginBalance
     */ 
    public function getLoginBalance()
    {
        return $this->loginBalance;
    }

    /**
     * Set the value of loginBalance
     *
     * @return  self
     */ 
    public function setLoginBalance($loginBalance)
    {
        $this->loginBalance = $loginBalance;

        return $this;
    }

}