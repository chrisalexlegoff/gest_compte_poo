<?php

namespace App\Model;

class Client
{
    // attributs
    private ?string $idClient;
    private string $nom;
    private string $prenom;
    private string $dateDeNaissance;
    private string $email;

    // methodes
    public function __construct(?string $idClient = null, string $nom = "", string $prenom = "", string $dateDeNaissance = "", string $email = "")
    {
        $this->idClient = $idClient;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->email = $email;
    }

    /**
     * Get the value of idClient
     *
     * @return ?string
     */
    public function getIdClient(): ?string
    {
        return $this->idClient;
    }

    /**
     * Set the value of idClient
     *
     * @param ?string $idClient
     *
     * @return self
     */
    public function setIdClient(?string $idClient): self
    {
        $this->idClient = $idClient;
        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param string $prenom
     *
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get the value of dateDeNaissance
     *
     * @return string
     */
    public function getDateDeNaissance(): string
    {
        return $this->dateDeNaissance;
    }

    /**
     * Set the value of dateDeNaissance
     *
     * @param string $dateDeNaissance
     *
     * @return self
     */
    public function setDateDeNaissance(string $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;
        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
}
