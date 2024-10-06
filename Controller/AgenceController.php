<?php

namespace Controller;

use Model\Agence;

require('Model/Agence.php');

/**
 * Controller Agence
 */
class AgenceController
{
    /**
     * Object agence
     *
     * @var object agence
     */
    private object $agence;

    /**
     * AgenceController constructor
     *
     * @param string|null $codeAgence
     * @param string $nomAgence
     * @param string $adresse
     */
    public function __construct(?string $codeAgence = null, string $nomAgence = "", string $adresse = "")
    {
        $this->agence = new Agence($codeAgence, $nomAgence, $adresse);
    }


    /**
     * Intitiate agence code
     *
     * @param array $agences
     */
    public function setcodeAgence(array $agences)
    {
        $id = 1;
        $codeAgence = str_pad($id, 3, "0", STR_PAD_LEFT);
        foreach ($agences as $elements) {
            foreach ($elements as $key => $value) {
                if ($key === "codeAgence") {
                    while ($codeAgence === $value) {
                        $codeAgence = str_pad(++$id, 3, "0", STR_PAD_LEFT);
                    }
                }
            }
        }
        $this->agence->setCodeAgence($codeAgence);
    }

    /**
     * Initiate agence name
     *
     * @param  mixed $nom
     */
    public function setNomAgence()
    {
        $nomAgence = readline("Entrer le nom de l'agence : ");
        while (!preg_match("/[a-zA-Z][\p{L}-]*$/", $nomAgence)) {
            change_color("red");
            echo ("Nom invalide !" . PHP_EOL);
            change_color("");
            $nomAgence = readline("Entrer le nom de l'agence : ");
        }
        $this->agence->setNomAgence($nomAgence);
    }

    /**
     * Verif double Name
     *
     * @param array $agences
     * @param string $reponse
     */
    public function verrifNomDoublon(array $agences, string &$reponse)
    {
        $nomAgence = $this->agence->getNomAgence();
        foreach ($agences as $elements) {
            foreach ($elements as $key => $value) {
                if ($key === "nomAgence") {
                    while ($nomAgence === $value) {
                        change_color("red");
                        echo ("Une entrée proche a été trouvée : " . PHP_EOL . PHP_EOL);
                        change_color("");
                        change_color("purple");
                        echo ("    Agence " . $elements["nomAgence"] . PHP_EOL .
                            "    Code : " . $elements["codeAgence"] . PHP_EOL .
                            "    Adresse: " . $elements["adresse"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $reponse = strtoupper(readline("Voulez-vous continuer (O)ui / (N)on ? "));
                        while ($reponse != "O" && $reponse != "N") {
                            change_color("red");
                            $reponse = strtoupper(readline("Réponse invalide, taper (O)ui / (N)on : "));
                            change_color("");
                        }
                        if ($reponse === "O") {
                            $this->agence->setNomAgence($nomAgence);
                            return $this->agence->getNomAgence();
                            break 3;
                        } else {
                            break 3;
                        }
                    }
                }
            }
        }
    }

    /**
     * initiate agence adresse
     *
     * @param  mixed $adresse
     */
    public function setAdresse()
    {
        $numeroRue = readline("entrer le numéro de la rue, si pas de numéro taper \"N\" : ");
        while (!preg_match("~^[0-9]+$~", $numeroRue)) {
            if ($numeroRue != "N") {
                change_color("red");
                echo ("numéro de la rue invalide !" . PHP_EOL);
                change_color("");
                $numeroRue = readline("Entrer le numéro de la rue : ");
            } else {
                $numeroRue = "";
                break;
            }
        }
        $rue = readline("Renseigner la rue (obligatoire) : ");
        while ($rue === "" || is_numeric($rue)) {
            change_color("red");
            echo ("Rue ou lieu-dit (obligatoire!)" . PHP_EOL);
            change_color("");
            $rue = readline("Renseigner la rue : ");
        }
        $codePostal = readline("entrer le code postal (obligatoire) : ");
        while (!preg_match("~^[0-9]{5}$~", $codePostal)) {
            change_color("red");
            echo ("Code postal invalide !" . PHP_EOL);
            change_color("");
            $codePostal = readline("Entrer le code postal : ");
        }
        $ville = readline("entrer la ville : ");
        while ($ville === "" || is_numeric($ville)) {
            change_color("red");
            echo ("ville invalide!" . PHP_EOL);
            change_color("");
            $ville = readline("Entrer la ville : ");
        }
        $adresse = "" . $numeroRue . " " . $rue . " " . $codePostal . " " . $ville;
        return $this->agence->setAdresse($adresse);
    }

    /**
     * Verif double Adress
     *
     * @param array $agences
     * @param string $reponse
     */
    public function verrifAdresseDoublon(array $agences, string &$reponse)
    {
        $adresse = $this->agence->getAdresse();
        foreach ($agences as $elements) {
            foreach ($elements as $key => $value) {
                if ($key === "nom") {
                    while ($adresse === $value) {
                        change_color("red");
                        echo ("Une entrée proche a été trouvée : " . PHP_EOL . PHP_EOL);
                        change_color("");
                        change_color("purple");
                        echo ("    Agence " . $elements["nomAgence"] . PHP_EOL .
                            "    Code : " . $elements["codeAgence"] . PHP_EOL .
                            "    Adresse: " . $elements["adresse"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $reponse = strtoupper(readline("Voulez-vous continuer (O)ui / (N)on ? "));
                        while ($reponse != "O" && $reponse != "N") {
                            change_color("red");
                            $reponse = strtoupper(readline("Réponse invalide, taper (O)ui / (N)on : "));
                            change_color("");
                        }
                        if ($reponse === "O") {
                            $this->agence->setAdresse($adresse);
                            return $this->agence->getAdresse();
                            break 3;
                        } else {
                            break 3;
                        }
                    }
                }
            }
        }
    }

    /**
     * Get the value of agence
     *
     * @return object
     */
    public function getAgence(): object
    {
        return $this->agence;
    }

    /**
     * Set the value of agence
     *
     * @param object $agence
     *
     * @return self
     */
    public function setAgence(object $agence): self
    {
        $this->agence = $agence;
        return $this;
    }
}
