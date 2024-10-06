<?php

namespace Controller;

require('Model/Compte.php');

use Model\Compte as ModelCompte;

/**
 * Compte Controller
 */
class CompteController
{
    /**
     * Object compte
     *
     * @var object
     */
    private object $compte;

    /**
     * CompteController constructor
     *
     * @param integer|null $numeroCompte
     * @param string|null $codeAgence
     * @param string|null $idClient
     * @param string $type
     * @param boolean $decouvert
     * @param float|null $decouvertMontant
     * @param float|null $solde
     * @param float|null $soldeLivretA
     * @param float|null $soldePel
     */
    public function __construct(?int $numeroCompte = null, ?string $codeAgence = null, ?string $idClient = null, string $type = "", bool $decouvert = false, ?float $decouvertMontant = null, ?float $solde = null, ?float $soldeLivretA = null, ?float $soldePel = null)
    {
        $this->compte = new ModelCompte($numeroCompte, $codeAgence,  $idClient, $type, $decouvert, $decouvertMontant, $solde, $soldeLivretA, $soldePel);
    }

    /**
     * Initiate compte number
     *
     * @param array $comptes
     * @return void
     */
    public function setNumeroCompte(array $comptes)
    {
        $numeroCompte = random_int(10000000000, 99999999999);
        foreach ($comptes as $elements) {
            foreach ($elements as $key => $value) {
                if ($key === "nom") {
                    while ($numeroCompte === $value) {
                        $numeroCompte = random_int(10000000000, 99999999999);
                    }
                }
            }
        }
        return $this->compte->setNumeroCompte($numeroCompte);
    }

    /**
     * Initiate Agence code
     *
     * @param array $agences
     * @return void
     */
    public function setCodeAgence(array $agences)
    {
        $quelleAgence = readline("enter le code agence : ");
        while (true) {
            foreach ($agences as $agence) {
                foreach ($agence as $key => $value) {
                    if ($key === "codeAgence" && $value === $quelleAgence) {
                        $compte["codeAgence"] = $quelleAgence;
                        change_color("green");
                        echo ("Agence saisie" . PHP_EOL);
                        change_color("");
                        break 3;
                    }
                }
            }
            change_color("red");
            $quelleAgence = readline("Entrée invalide : enter le code agence choisi : ");
            change_color("");
        }
        $this->compte->setCodeAgence($quelleAgence);
    }

    /**
     * Initiate Client ID
     *
     * @param array $clients
     * @return void
     */
    public function setIdClient(array $clients)
    {
        $quelClient = readline("enter le code client choisi : ");
        while (true) {
            foreach ($clients as $client) {
                foreach ($client as $key => $value) {
                    if ($key === "idClient" && $value === $quelClient) {
                        $compte["idClient"] = $quelClient;
                        change_color("green");
                        echo ("client saisi" . PHP_EOL);
                        change_color("");
                        break 3;
                    }
                }
            }
            change_color("red");
            $quelClient = readline("Entrée invalide : enter le code client choisi : ");
            change_color("");
        }
        $this->compte->setIdClient($quelClient);
    }

    /**
     * Initiate Compte Type
     *
     * @param string $type
     * @return void
     */
    public function setType(string $type)
    {
        $this->compte->setType($type);
    }

    /**
     * initiate Compte Solde
     *
     * @param float $solde
     * @return void
     */
    public function setSolde(float $solde)
    {
        $this->compte->setSolde($solde);
    }


    /**
     * Initiate Decouvert authorization
     *
     * @param boolean $decouvert
     * @return void
     */
    public function setDecouvert(bool $decouvert)
    {
        $this->compte->setDecouvert($decouvert);
    }


    /**
     * Verif max 3 comptes
     *
     * @param array $comptes
     * @param integer $cptCompte
     * @param boolean $courant
     * @param boolean $pel
     * @param boolean $livretA
     * @return void
     */
    public function nbreCompte(array $comptes, int &$cptCompte, ?bool &$courant = false, ?bool &$pel = false, ?bool &$livretA = false)
    {
        $cptCompte = 0;
        foreach ($comptes as $elements) {
            $elements = (array)$elements;
            if ($elements["idClient"] === $this->compte->getIdClient()) {
                if ($elements["type"] === "PEL") {
                    $pel = true;
                    $cptCompte++;
                } elseif ($elements["type"] === "Courant") {
                    $courant = true;
                    $cptCompte++;
                } elseif ($elements["type"] === "LivretA") {
                    $livretA = true;
                    $cptCompte++;
                }
            }
        }
    }


    public function setDecouvertMontant($decouvertMontant)
    {
        $this->compte->setDecouvertMontant($decouvertMontant);
    }

    /**
     * setSoldeLivretA
     *
     * @param  mixed $soldeLivretA
     * @return void
     */
    public function setSoldeLivretA($soldeLivretA)
    {
        $this->compte->setSoldeLivretA($soldeLivretA);
    }

    /**
     * setSoldePel
     *
     * @param  mixed $soldePel
     * @return void
     */
    public function setSoldePel($soldePel)
    {
        $this->compte->setSoldePel($soldePel);
    }

    /**
     * Get the value of compte
     *
     * @return object
     */
    public function getCompte(): object
    {
        return $this->compte;
    }

    /**
     * Set the value of compte
     *
     * @param object $compte
     *
     * @return self
     */
    public function setCompte(object $compte): self
    {
        $this->compte = $compte;
        return $this;
    }

    public function rechercherCompte($comptes, $clients)
    {
        var_dump($comptes);
        $trouve = 0;
        while (true) {

            if (!isset($comptes) || empty($comptes)) {
                change_color("red");
                echo ("Aucun compte existant!" . PHP_EOL);
                $reponse = strtoupper(readline("appuyer sur une touche pour revenir au menu et selectionner 3 "));
                change_color("");
                break;
            }
            echo (PHP_EOL);
            $compteRecherche = (int)readline("Saisir le numero de compte : ");
            while ($compteRecherche === "") {
                change_color(("red"));
                $compteRecherche = (int)readline("Invalide! Veuillez Saisir le numéro de compte du client à afficher : ");
                change_color("");
            }
            while (true) {
                foreach ($comptes as $keys => $compte) {
                    foreach ($compte as $key => $value) {
                        if ($compteRecherche === (int)$value) {
                            $idClient = $compte["idClient"];
                            $trouve = 1;
                            break 3;
                        }
                    }
                }
                if ($trouve != 1) {
                    change_color("red");
                    readline("Aucun compte trouvé avec ce numéro de compte ! appuyer sur une touche pour continuer");
                    change_color("");
                    $trouve = 0;
                    break;
                }
            }
            if (isset($idClient)) {
                while (true) {
                    foreach ($clients as $cles => $client) {
                        foreach ($client as $cle => $val) {
                            if ($cle === "idClient" && $val === $idClient) {
                                break 3;
                            }
                        }
                    }
                }
            } else {
                break;
            }

            require './Views/afficherComptesClients.php';
            readline("Appuyer sur entrer");
            break;
        }
    }

    public function simulerFraisDeCompte($comptes, $clients)
    {
        $fraisTenueCompte = 25;
        $trouve = 0;
        while (true) {

            if (empty($comptes)) {
                change_color("red");
                echo ("Aucun compte existant!" . PHP_EOL);
                $reponse = strtoupper(readline("appuyer sur une touche pour revenir au menu et selectionner 3 "));
                change_color("");
                break;
            }
            echo (PHP_EOL);
            $compteRecherche = (int)readline("Saisir le numero de compte : ");
            while ($compteRecherche === "") {
                change_color(("red"));
                $compteRecherche = readline("Invalide! Veuillez Saisir le numéro de compte pour demarrer la simulation : ");
                change_color("");
            }
            while (true) {
                foreach ($comptes as $keys => $compte) {
                    foreach ($compte as $key => $value) {
                        if ($compteRecherche === (int)$value) {
                            $idClient = $compte["idClient"];
                            $trouve = 1;
                            break 3;
                        }
                    }
                }
                if ($trouve != 1) {
                    change_color("red");
                    readline("Aucun compte trouvé avec ce numéro de compte ! appuyer sur une touvhe pour continuer");
                    change_color("");
                    $trouve = 0;
                    break;
                }
            }

            if (isset($idClient)) {
                while (true) {
                    foreach ($clients as $cles => $client) {
                        foreach ($client as $cle => $val) {
                            if ($cle === "idClient" && $val === $idClient) {
                                break 3;
                            }
                        }
                    }
                }
            }

            $duree = (int)readline("Saisir le nombre d'années : ");
            while ($duree === "" || !is_numeric($duree)) {
                change_color("red");
                $duree = (int)readline("Invalide! Saisir le nombre d'années : ");
                change_color("");
            }
            require('./Views/afficherSimulateurFrais.php');
            readline("Appuyer sur entrer pour continuer ...");
            break;
        }
    }
}
