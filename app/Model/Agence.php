<?php

namespace App\Model;

class Agence
{
    // attributs
    private ?string $codeAgence;
    private string $nomAgence;
    private string $adresse;

    // méthodes
    public function __construct(?string $codeAgence = null, string $nomAgence = "", string $adresse = "")
    {
        $this->codeAgence = $codeAgence;
        $this->nomAgence = $nomAgence;
        $this->adresse = $adresse;
    }

    /**
     * Get the value of codeAgence
     *
     * @return ?string
     */
    public function getCodeAgence(): ?string
    {
        return $this->codeAgence;
    }

    /**
     * Set the value of codeAgence
     *
     * @param ?string $codeAgence
     *
     * @return self
     */
    public function setCodeAgence(?string $codeAgence): self
    {
        $this->codeAgence = $codeAgence;
        return $this;
    }

    /**
     * Get the value of nomAgence
     *
     * @return string
     */
    public function getNomAgence(): string
    {
        return $this->nomAgence;
    }

    /**
     * Set the value of nomAgence
     *
     * @param string $nomAgence
     *
     * @return self
     */
    public function setNomAgence(string $nomAgence): self
    {
        $this->nomAgence = $nomAgence;
        return $this;
    }

    /**
     * Get the value of adresse
     *
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @param string $adresse
     *
     * @return self
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }
}
