<?php
// On crée la classe Infractions
class Infraction {
    private string $codeInfraction; 
    private string $categorie;

    private float $tarif;

// On crée la méthode construct qui initialise les attributs de l'objet
    public function __construct(string $codeInfraction,string $categorie, float $tarif) {
        $this->codeInfraction = $codeInfraction;
        $this->categorie = $categorie;
        $this->tarif = $tarif; 
    }



    /**
     * Get the value of categorie
     */ 
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set the value of categorie
     *
     * @return  self
     */ 
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
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
     * Get the value of tarif
     */ 
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set the value of tarif
     *
     * @return  self
     */ 
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }
}