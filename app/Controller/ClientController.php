<?php

namespace App\Controller;

use App\Model\Client;

/**
 * Controller Client
 */
class ClientController
{
    /* Object client
     *
     * @var object
     */
    private object $client;

    /**
     * ClientController Constructor
     *
     * @param string|null $idClient
     * @param string $nom
     * @param string $prenom
     * @param string $dateDeNaissance
     * @param string $email
     */
    public function __construct(?string $idClient = null, string $nom = "", string $prenom = "", string $dateDeNaissance = "", string $email = "")
    {
        $this->client = new Client($idClient,  $nom,  $prenom,  $dateDeNaissance,  $email);
    }



    /**
     * Initiate idClient
     *
     * @param integer $idClient
     * @param array $clients
     * @return void
     */
    public function setidClient(array $clients)
    {
        $idClient = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2)) . random_int(100000, 999999);
        foreach ($clients as $elements) {
            foreach ($elements as $key => $value) {
                if ($key === "code") {
                    while ($idClient === $value) {
                        $idClient = strtoupper(substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 2)) . random_int(100000, 999999);
                    }
                }
            }
        }
        $this->client->setidClient($idClient);
    }

    /**
     * setNom
     *
     * @param  mixed $nom
     * @return void
     */
    public function setNom()
    {
        $nom = readline("Entrer le nom du client : ");

        while (!preg_match("/[a-zA-Z][\p{L}-]*$/", $nom)) {
            change_color("red");
            echo ("Nom invalide !" . PHP_EOL);
            change_color("");
            $nom = readline("Entrer le nom du client : ");
        }
        $this->client->setNom($nom);
    }

    /**
     * Verif double Client name
     *
     * @param array $clients
     * @param string $reponse
     * @return void
     */
    public function verrifNomDoublon(array $clients, string &$reponse)
    {
        $nom = $this->client->getNom();
        foreach ($clients as $elements) {
            $elements = (array)$elements;
            foreach ($elements as $key => $value) {
                if ($key === "nom") {
                    while ($nom === $value) {
                        change_color("red");
                        echo ("Une entrée proche a été trouvée : " . PHP_EOL . PHP_EOL);
                        change_color("");
                        change_color("purple");
                        echo ("    Client " . $elements["nom"] . PHP_EOL .
                            "    ID : " . $elements["idClient"] . PHP_EOL .
                            "    Mail : " . $elements["email"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $reponse = strtoupper(readline("Voulez-vous continuer (O)ui / (N)on ? "));
                        while ($reponse != "O" && $reponse != "N") {
                            change_color("red");
                            $reponse = strtoupper(readline("Réponse invalide, taper (O)ui / (N)on : "));
                            change_color("");
                        }
                        if ($reponse === "O") {
                            $this->client->setNom($nom);
                            return $this->client->getNom();
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
     * setPrenom
     *
     * @param  mixed $prenom
     * @return void
     */
    public function setPrenom()
    {
        $prenom = readline("Entrer le prenom : ");
        while (!preg_match("/[a-zA-Z][\p{L}-]*$/", $prenom)) {
            change_color("red");
            echo ("Prénom invalide !" . PHP_EOL);
            change_color("");
            $prenom = readline("Entrer le prénom du client : ");
        }
        $this->client->setPrenom($prenom);
    }


    /**
     * setDateDeNaissance
     *
     * @param  mixed $dateDeNaissance
     * @return void
     */
    public function setDateDeNaissance()
    {
        $jour = (int)readline("entrer le jour de naissance : ");
        change_color("red");
        while (!is_numeric($jour) || $jour < 1 || $jour > 31) {
            $jour = (int)readline("entrer 1 jour de naissance entre 1 et 31 : ");
        }
        change_color("");
        $mois = (int)readline("entrer le mois de naissance : ");
        change_color("red");
        while (!is_numeric($mois) || $mois < 1 || $mois > 12) {
            $mois = (int)readline("entrer 1 mois de naissance entre 1 et 12 : ");
        }
        change_color("");
        $annee = (int)readline("entrer l'année de naissance : ");
        change_color("red");
        while (!is_numeric($annee) || $annee < (date("Y") - 100) || $annee > date("Y") - 18) {
            $annee = (int)readline("entrer 1 année de naissance valide (+18ans) : ");
        }
        change_color("");

        while (!checkdate($mois, $jour, $annee) || $annee > (date("Y") - 18) || $annee < 1900) {
            change_color("red");
            echo ("Date de naissance invalide ! (+18ans)" . PHP_EOL);
            change_color("");
            $jour = (int)readline("entrer le jour de naissance : ");
            change_color("red");
            while (!is_numeric($jour) || $jour < 1 || $jour > 31) {
                $jour = (int)readline("entrer 1 jour de naissance entre 1 et 31 : ");
            }
            change_color("");
            $mois = (int)readline("entrer le mois de naissance : ");
            change_color("red");
            while (!is_numeric($mois) || $mois < 1 || $mois > 12) {
                $mois = (int)readline("entrer 1 mois de naissance entre 1 et 12 : ");
            }
            change_color("");
            $annee = (int)readline("entrer l'année de naissance : ");
            change_color("red");
            while (!is_numeric($annee) || $annee < (date("Y") - 100) || $annee > date("Y") - 18) {
                $annee = (int)readline("entrer 1 année de naissance valide (+18ans) : ");
            }
            change_color("");
        }

        $dateDeNaissance = $jour . "/" . $mois . "/" . $annee;
        $this->client->setDateDeNaissance($dateDeNaissance);
    }

    /**
     * setEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function setEmail()
    {
        $email = readline("Entrez l'email : ");
        while (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            change_color("red");
            $email = readline("Email invalide, Entrez l'email ( --- @ --- . com, fr ): ");
            change_color("");
        }
        $this->client->setEmail($email);
    }

    /**
     * Verif double Client Email
     *
     * @param array $clients
     * @return void
     */
    public function verrifEmailDoublon(array $clients)
    {
        $email = $this->client->getEmail();
        foreach ($clients as $client) {
            foreach ($client as $key => $value) {
                if ($key === "mail") {
                    while ($email === $value) {
                        change_color("red");
                        echo ("L'adresse email " . $email . " existe déjà : " . PHP_EOL . PHP_EOL);
                        change_color("");
                        change_color("purple");
                        echo ("    Client " . $this->client->nom . PHP_EOL .
                            "    ID : " . $this->client->idClient . PHP_EOL .
                            "    Mail : " . $this->client->email . PHP_EOL . PHP_EOL);
                        change_color("");
                        $reponse = strtoupper(readline("Voulez-vous continuer ? (O)ui / (N)on) : "));
                        while ($reponse != "O" && $reponse != "N") {
                            change_color("red");
                            $reponse = strtoupper(readline("Réponse invalide, taper (O)ui / (N)on : "));
                            change_color("red");
                        }
                        if ($reponse === "O") {
                            $client["mail"] = $email;
                            break 3;
                        } elseif ($reponse === "N") {
                            break 3;
                        }
                    }
                }
            }
        }
    }

    /**
     * Get the value of client
     *
     * @return object
     */
    public function getClient(): object
    {
        return $this->client;
    }

    /**
     * Set the value of client
     *
     * @param object $client
     *
     * @return self
     */
    public function setClient(object $client): self
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Search Client Comptes By ID and shw them
     *
     * @param array $comptes
     * @param array $clients
     * @return void
     */
    public function afficherComptesClientById(array $comptes, array $clients)
    {
        while (true) {
            $trouve = 0;
            $clientRecherche = readline("Saisir l'identifiant du client à afficher : ");
            while ($clientRecherche === "") {
                change_color(("red"));
                $clientRecherche = readline("Invalide! Veuillez Saisir l'identifiant client recherché : ");
                change_color("");
            }
            while (true) {
                foreach ($comptes as $keys => $compte) {
                    foreach ($compte as $key => $value) {
                        if ($clientRecherche === $value) {
                            $idClient = $compte["idClient"];
                            $trouve = 1;
                            break 3;
                        }
                    }
                }
                if ($trouve != 1) {
                    change_color("red");
                    readline("Ce client n'existe pas ou ne possède pas encore de compte ! appuyer sur une touche pour retourner au menu principal : ");
                    change_color("");
                    $trouve = 0;
                    break 2;
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

            require ROOT_PATH . 'Views/afficherComptesClients.php';
            readline("Appuyer sur entrer");
            break;
        }
    }

    /**
     * Search Client and print infos in txt
     *
     * @param array $comptes
     * @param array $clients
     * @return void
     */
    public function imprimerInfosClients(array $comptes, array $clients)
    {
        while (true) {
            $cptCompte = 0;
            $cptClient = 0;

            $clientRecherche = readline("Saisir l'identifiant du client à afficher : ");
            foreach ($clients as $client) {
                if ($clientRecherche != $client["idClient"]) {
                    $cptClient++;
                }
            }
            if ($cptClient === count($clients)) {
                echo ("Identifiant inconnu" . PHP_EOL);
                break;
            }

            while (true) {
                foreach ($comptes as $keys => $compte) {
                    foreach ($compte as $key => $value) {
                        if ($clientRecherche === $value) {
                            $idClient = $compte["idClient"];
                            $cptCompte++;
                        }
                    }
                }

                break;
            }

            if ($cptCompte === 0) {
                change_color("red");
                readline("Ce client ne posséde pas de compte");
                change_color("");
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


            $afficherFicheClient = (ROOT_PATH . "sauv/clients/Infosclient.txt");
            $f = fopen($afficherFicheClient, 'w');

            $ficheClient = ("                      Fiche client" . PHP_EOL . PHP_EOL .
                "Numéro client : " . $client["idClient"] . PHP_EOL .
                "Nom : " . $client["nom"] . PHP_EOL .
                "Prénom : " . $client["prenom"] . PHP_EOL .
                "Date de naissance : " . $client["dateDeNaissance"] . PHP_EOL . PHP_EOL .
                "_____________________________________________________________________" . PHP_EOL .
                "Liste de compte" . PHP_EOL .
                "_____________________________________________________________________" . PHP_EOL .
                "Numéro de compte                  Solde" . PHP_EOL .
                "_____________________________________________________________________" . PHP_EOL . PHP_EOL);


            fwrite($f, $ficheClient);
            if (isset($idClient)) {
                while (true) {
                    foreach ($comptes as $cles => $compte) {
                        foreach ($compte as $cle => $val) {
                            if ($cle === "idClient" && $val === $idClient) {
                                if ($compte["solde"] >= 0 && $compte["solde"] != "") {
                                    $courant = ("    " . $compte["numeroCompte"] . "                   " . $compte["solde"] . "                   :-)" . PHP_EOL);
                                    fwrite($f, $courant);
                                } elseif ($compte["solde"] <= 0 && $compte["solde"] != "") {
                                    $courant = ("    " . $compte["numeroCompte"] . "                   " . $compte["solde"] . "                   :-(" . PHP_EOL);
                                    fwrite($f, $courant);
                                }
                                if ($compte["soldeLivretA"] >= 0 && $compte["soldeLivretA"] != "") {
                                    $livretA = ("    " . $compte["numeroCompte"] . "                   " . $compte["soldeLivretA"] . "                   :-)" . PHP_EOL);
                                    fwrite($f, $livretA);
                                } elseif ($compte["soldeLivretA"] <= 0 && $compte["soldeLivretA"] != "") {
                                    $livretA = ("    " . $compte["numeroCompte"] . "                   " . $compte["soldeLivretA"] . "                   :-(" . PHP_EOL);
                                    fwrite($f, $livretA);
                                }
                                if ($compte["soldePel"] >= 0 && $compte["soldePel"] != "") {
                                    $pel = ("    " . $compte["numeroCompte"] . "                   " . $compte["soldePel"] . "                   :-)" . PHP_EOL);
                                    fwrite($f, $pel);
                                } elseif ($compte["soldePel"] <= 0 && $compte["soldePel"] != "") {
                                    $pel = ("    " . $compte["numeroCompte"] . "                   " . $compte["soldePel"] . "                   :-(" . PHP_EOL);
                                    fwrite($f, $pel);
                                }
                            }
                        }
                    }
                    break;
                }

                fclose($f);
                change_color("green");
                echo ("Document imprimé dans " . $afficherFicheClient . PHP_EOL);
                change_color("");
                readline("Appuyer sur entrer pour continuer ...");
                break;
            }
        }
    }

    /**
     * Search Client by Name, ID or Compte number and show them
     *
     * @param array $comptes
     * @param array $clients
     * @return void
     */
    public function rechercheClientByNomOrNumeroCompteOrId(array $comptes, array $clients)
    {
        while (true) {
            $trouve = 0;
            if (empty($comptes)) {
                echo ("Aucun compte existant!" . PHP_EOL);
                $reponse = strtoupper(readline("appuyer sur une touche pour revenir au menu et selectionner 3 "));
                break;
            }

            echo ("Rechercher par : " . PHP_EOL . PHP_EOL .
                "--------------------------" . PHP_EOL .
                " 1. Nom" . PHP_EOL .
                " 2. Numéro de compte" . PHP_EOL .
                " 3. identifiant de client" . PHP_EOL .
                "--------------------------" . PHP_EOL .
                " 4. Quitter" . PHP_EOL . PHP_EOL);

            $choixRecherche = (int)readline("Entrer votre choix : ");
            while (true) {

                if (!is_numeric($choixRecherche) || $choixRecherche < 1 || $choixRecherche > 4 || $choixRecherche === "") {
                    change_color("red");
                    $choixCompte = (int)readline("Invalide : Entrer votre choix : ");
                    change_color("");
                }
                break;
            }

            if ($choixRecherche === 4) {
                break;
            } elseif ($choixRecherche === 1) {

                while (true) {

                    $clientRecherche = readline("Saisir le nom du client à afficher : ");
                    change_color("red");
                    while ($clientRecherche === "") {
                        $clientRecherche = readline("Invalide! Veuillez Saisir le nom du client à afficher");
                    }
                    change_color("");
                    while (true) {
                        foreach ($clients as $keys => $client) {
                            foreach ($client as $key => $value) {
                                if ($clientRecherche === $value) {
                                    $idClient = $client["idClient"];
                                    $trouve = 1;
                                    break 3;
                                }
                            }
                        }
                        if ($trouve != 1) {
                            change_color("red");
                            readline("Ce client n'existe pas ou ne possède pas encore de compte ! appuyer sur une touche pour retourner au menu principal : ");
                            change_color("");
                            unset($idClient);
                            $trouve = 0;
                            break 2;
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
                    require ROOT_PATH . 'Views/afficherComptesClients.php';
                    readline("Appuyer sur entrer");
                    break;
                }
            } elseif ($choixRecherche === 2) {

                while (true) {

                    echo (PHP_EOL);
                    $clientRecherche = readline("Saisir le numéro de compte du client à afficher : ");
                    change_color("red");
                    while ($clientRecherche === "") {
                        $clientRecherche = readline("Invalide! Saisir le numéro de compte du client à afficher : ");
                    }
                    change_color("");

                    while (true) {
                        foreach ($comptes as $keys => $compte) {
                            foreach ($compte as $key => $value) {
                                if ($clientRecherche === $value) {
                                    $idClient = $compte["idClient"];
                                    $trouve = 1;
                                    break 3;
                                }
                            }
                        }
                        if ($trouve != 1) {
                            change_color("red");
                            readline("Ce client n'existe pas ou ne possède pas encore de compte ! appuyer sur une touche pour retourner au menu principal : ");
                            change_color("");
                            unset($idClient);
                            $trouve = 0;
                            break 2;
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
                    require ROOT_PATH . 'Views/afficherComptesClients.php';
                    readline("Appuyer sur entrer");
                    break;
                }
            } elseif ($choixRecherche === 3) {

                while (true) {

                    echo (PHP_EOL);
                    $clientRecherche = readline("Saisir l'identifiant du client à afficher : ");
                    while ($clientRecherche === "") {
                        change_color(("red"));
                        $clientRecherche = readline("Invalide! Veuillez Saisir l'identifiant du client à afficher : ");
                        change_color("");
                    }
                    while (true) {
                        foreach ($comptes as $keys => $compte) {
                            foreach ($compte as $key => $value) {
                                if ($clientRecherche === $value) {
                                    $idClient = $compte["idClient"];
                                    $trouve = 1;
                                    break 3;
                                }
                            }
                        }
                        if ($trouve != 1) {
                            change_color("red");
                            readline("Ce client n'existe pas ou ne possède pas encore de compte ! appuyer sur une touche pour retourner au menu principal : ");
                            change_color("");
                            unset($idClient);
                            $trouve = 0;
                            break 2;
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
                    require ROOT_PATH . 'Views/afficherComptesClients.php';
                    readline("Appuyer sur entrer");
                    break;
                }
            }
        }
    }
}
