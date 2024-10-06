<?php

namespace Model;

class Compte
{
    //attributs
    private ?int $numeroCompte;
    private ?string $codeAgence;
    private ?string $idClient;
    private string $type;
    private bool $decouvert;
    private ?float $decouvertMontant;
    private ?float $solde;
    private ?float $soldeLivretA;
    private ?float $soldePel;

    // méthodes
    public function __construct(?int $numeroCompte = null, ?string $codeAgence = null, ?string $idClient = null, string $type = "", bool $decouvert = false, ?float $decouvertMontant = null, ?float $solde = null, ?float $soldeLivretA = null, ?float $soldePel = null)
    {
        $this->numeroCompte = $numeroCompte;
        $this->codeAgence = $codeAgence;
        $this->idClient = $idClient;
        $this->type = $type;
        $this->decouvert = $decouvert;
        $this->decouvertMontant = $decouvertMontant;
        $this->solde = $solde;
        $this->soldeLivretA = $soldeLivretA;
        $this->soldePel = $soldePel;
    }
    /**
     * Get the value of numeroCompte
     */
    public function getNumeroCompte()
    {
        return $this->numeroCompte;
    }

    /**
     * Set the value of numeroCompte
     */
    public function setNumeroCompte($numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;
        return $this;
    }

    /**
     * Get the value of codeAgence
     */
    public function getCodeAgence()
    {
        return $this->codeAgence;
    }

    /**
     * Set the value of codeAgence
     */
    public function setCodeAgence($codeAgence): self
    {
        $this->codeAgence = $codeAgence;
        return $this;
    }

    /**
     * Get the value of idClient
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set the value of idClient
     */
    public function setIdClient($idClient): self
    {
        $this->idClient = $idClient;
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
     */
    public function setType($type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the value of decouvert
     */
    public function getDecouvert()
    {
        return $this->decouvert;
    }

    /**
     * Set the value of decouvert
     */
    public function setDecouvert($decouvert): self
    {
        $this->decouvert = $decouvert;
        return $this;
    }

    /**
     * Get the value of decouvertMontant
     */
    public function getDecouvertMontant()
    {
        return $this->decouvertMontant;
    }

    /**
     * Set the value of decouvertMontant
     */
    public function setDecouvertMontant($decouvertMontant): self
    {
        $this->decouvertMontant = $decouvertMontant;
        return $this;
    }

    /**
     * Get the value of solde
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set the value of solde
     */
    public function setSolde($solde): self
    {
        $this->solde = $solde;
        return $this;
    }

    /**
     * Get the value of soldeLivretA
     */
    public function getSoldeLivretA()
    {
        return $this->soldeLivretA;
    }

    /**
     * Set the value of soldeLivretA
     */
    public function setSoldeLivretA($soldeLivretA): self
    {
        $this->soldeLivretA = $soldeLivretA;
        return $this;
    }

    /**
     * Get the value of soldePel
     */
    public function getSoldePel()
    {
        return $this->soldePel;
    }

    /**
     * Set the value of soldePel
     */
    public function setSoldePel($soldePel): self
    {
        $this->soldePel = $soldePel;
        return $this;
    }
}
