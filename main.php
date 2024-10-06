<?php

use App\Controller\AgenceController;
use App\Controller\ClientController;
use App\Controller\CompteController;

require 'vendor/autoload.php';
require 'app/lib/init.php';
include_once(ROOT_PATH . "lib/utils.php");
include_once(ROOT_PATH . "lib/function.php");

$cptCompte = 0;

while (true) {

    // Récupérations de tous les enregistrements 'csv' => Array of objects;
    $agences = [];
    csvToArray($agences, $filename = ROOT_PATH . 'sauv/agences/agences.csv', $delimiter = ',');
    $clients = [];
    csvToArray($clients, $filename = ROOT_PATH . 'sauv/clients/clients.csv', $delimiter = ',');
    $comptes = [];
    csvToArray($comptes, $filename = ROOT_PATH . 'sauv/comptes/comptes.csv', $delimiter = ',');

    $clientController = new ClientController();
    $agenceController = new AgenceController();
    $compteController = new CompteController();

    // Menu Principal pour le programme de gestion de comptes bancaires
    change_color("blue");
    echo (PHP_EOL . "Menu :" . PHP_EOL . PHP_EOL);
    change_color("");
    change_color("purple");
    echo ("   ---------------------- Gestion Banque ----------------------------" . PHP_EOL .
        "   1- Créer une agence" . PHP_EOL .
        "   2- créer un client" . PHP_EOL .
        "   3- Créer un compte bancaire" . PHP_EOL .
        "   4- Recherche de compte (numéro de compte)" . PHP_EOL .
        "   5- Recherche de client (Nom, Numéro de compte, identifiant de client)" . PHP_EOL .
        "   6- Afficher la liste des comptes d’un client (identifiant client)" . PHP_EOL .
        "   7- Imprimer les infos client (identifiant client)" . PHP_EOL .
        "   8- Simuler frais de gestion" . PHP_EOL .
        "   ---------------------------------------------------------------------" . PHP_EOL .
        "   9- Quitter le programme" . PHP_EOL .
        "   ---------------------------------------------------------------------" . PHP_EOL . PHP_EOL);
    change_color("");
    change_color("blue");
    $choixMenu = (int)(readline("Votre choix : "));
    change_color("");
    echo (PHP_EOL);
    while (true) {
        if (!is_numeric($choixMenu) || $choixMenu < 1 || $choixMenu > 9) {
            change_color("red");
            $choixMenu = (int)(readline("choix  invalide : "));
            change_color("");
        } else {
            break;
        }
    }

    if ($choixMenu === 9) {

        break;
    } elseif ($choixMenu === 1) {

        // Menu 1 : Créer une agence
        $reponse = 'y';

        while ($reponse != "N") {
            $agenceController->setCodeAgence($agences);
            $agenceController->setNomAgence();
            $agenceController->verrifNomDoublon($agences, $reponse);
            if ($reponse === "N") {
                break;
            }
            $agenceController->setAdresse();
            $agenceController->verrifAdresseDoublon($agences, $reponse);
            if ($reponse === "N") {
                break;
            }
            $agences[] = $agenceController->getAgence();
            arrayToCsv($agences, $filename = ROOT_PATH . 'sauv/agences/agences.csv', $delimiter = ',', $header = array("codeAgence", "nomAgence", "adresse"));
            change_color("purple");
            echo ("L'agence' n° " . $agenceController->getAgence()->getcodeAgence() . " a bien été créée" . PHP_EOL);
            change_color("");
            readline("Appuyer sur entrer ...");
            break;
        }
    } elseif ($choixMenu === 2) {

        // Menu 2 : Créer un client
        $reponse = 'y';

        while ($reponse != "N") {
            $clientController->setidClient($clients);
            $clientController->setNom();
            $clientController->verrifNomDoublon($clients, $reponse);
            if ($reponse === "N") {
                break;
            }
            $clientController->setPrenom();
            $clientController->setDateDeNaissance();
            $clientController->setEmail();
            $clientController->verrifEmailDoublon($clients);
            $clients[] = $clientController->getClient();
            arrayToCsv($clients, $filename = ROOT_PATH . 'sauv/clients/clients.csv', $delimiter = ',', $header = array("idClient", "nom", "prenom", "dateDeNaissance", "email"));
            change_color("purple");
            echo ("Le client n° " . $clientController->getClient()->getidClient() . " a bien été créé" . PHP_EOL);
            change_color("");
            readline("Appuyer sur entrer ...");
            break;
        }
    } elseif ($choixMenu === 3) {

        // Menu 3 : Créer un compte bancaire
        $reponse = 'y';

        while ($reponse != "N") {
            if (empty($agences)) {
                change_color("red");
                echo ("Aucune agence créée !!" . PHP_EOL);
                change_color("");
                $reponse = strtoupper(readline("appuyer sur une touche pour revenir au menu et selectionner 1 "));
                break;
            }
            if (empty($clients)) {
                change_color("red");
                echo ("Aucun client créée !!" . PHP_EOL);
                change_color("");
                $reponse = strtoupper(readline("appuyer sur une touche pour revenir au menu et selectionner 2 "));
                break;
            }
            $compteController->setCodeAgence($agences);
            $compteController->setIdClient($clients);
            $compteController->nbreCompte($comptes, $cptCompte, $courant, $pel, $livretA);
            while (true) {
                echo ("Veuillez sélectionner le type de compte : " . PHP_EOL . PHP_EOL .
                    "------------------------------" . PHP_EOL .
                    " 1. Compte courant" . PHP_EOL .
                    " 2. Livret A" . PHP_EOL .
                    " 3. Plan Epargne Logement" . PHP_EOL .
                    "------------------------------" . PHP_EOL .
                    " 4. Revenir au menu principal" . PHP_EOL . PHP_EOL);

                $choixCompte = (int)readline("Entrer votre choix : ");
                while (true) {
                    if (!is_numeric($choixCompte) || $choixCompte < 1 || $choixCompte > 4) {
                        change_color("red");
                        $choixCompte = (int)readline("Invalide : Entrer votre choix : ");
                        change_color("");
                    }
                    break;
                }

                if ($cptCompte >= 3) {
                    change_color("red");
                    $reponse = strtoupper(readline("Le client n° " . $compteController->getCompte()->getIdClient() . " possède déjà 3 comptes, appuyer sur touche pour revenir au menu principal"));
                    change_color("");
                    break 2;
                }

                if ($choixCompte === 4) {

                    break;
                } elseif ($choixCompte === 1) {
                    if (isset($courant) && $courant) {
                        change_color("red");
                        $reponse = strtoupper(readline("Le client n° " . $compteController->getCompte()->getIdClient() . " possède déjà un compte courant, appuyer sur une touche"));
                        change_color("");
                        break 2;
                    }
                    $compteController->setType("Courant");
                    $reponse = strtoupper(readline("Découvert autorisé (O/n) : "));
                    while (true) {
                        if ($reponse != "O" && $reponse != "N") {
                            change_color("red");
                            $reponse = strtoupper(readline("invalide! : Découvert autorisé (O/n) : "));
                            change_color("");
                        } else {
                            break;
                        }
                    }

                    if ($reponse === "O") {
                        $compteController->setDecouvert($decouvert = true);
                        $reponse = (float)(readline("montant du découvert (100 <--> 1000 euros) : "));
                        while (true) {
                            if (!is_numeric($reponse) || $reponse < 100 || $reponse > 1000) {
                                change_color("red");
                                $reponse = (float)(readline("invalide! : montant du découvert (100 <--> 1000 euros) : "));
                                change_color("");
                            } else {
                                break;
                            }
                        }
                        $compteController->setDecouvertMontant($reponse);
                    } else {
                        $compteController->setDecouvert($decouvert = false);
                        $compteController->setDecouvertMontant(null);
                    }

                    $reponse = (float)(readline("solde du compte (max 10 000 euros) : "));
                    if ($compteController->getCompte()->getDecouvert() === true) {
                        while (true) {
                            if ($reponse === 0 || !is_numeric($reponse) || $reponse < -$compteController->getCompte()->getDecouvertMontant() || $reponse > 10000) {
                                change_color("red");
                                if ($reponse < -$compteController->getCompte()->getDecouvertMontant()) {
                                    echo ("invalide! : découvert autorisé (" . $compteController->getCompte()->getDecouvertMontant() . " euros) dépassé. " . PHP_EOL);
                                    $reponse = (float)(readline("solde du compte (max 10 000 euros) : "));
                                } elseif ($reponse > 10000) {
                                    echo ("invalide! : solde max (10 000 euros) : " . PHP_EOL);
                                    $reponse = (float)(readline("solde du compte (max 10 000 euros) : "));
                                } elseif ($reponse === 0) {
                                    echo ("invalide! saisir un montant : solde max (10 000 euros) : " . PHP_EOL);
                                    $reponse = (float)(readline("solde du compte (max 10 000 euros) : "));
                                } else {
                                }
                                change_color("");
                            }
                            break;
                        }

                        $compteController->setSolde($reponse);
                    } elseif ($compteController->getCompte()->getDecouvert() === false) {
                        while (true) {
                            if (!is_numeric($reponse) || $reponse < 0 || $reponse > 10000) {
                                change_color("red");
                                $reponse = (float)(readline("Découvert non autorisé pour ce compte! : montant max (10 000 euros)."));
                                change_color("");
                            } else {
                                break;
                            }
                        }
                        $compteController->setSolde($reponse);
                    }
                    $comptes[] = $compteController->getCompte();
                    $reponse = readline("appuyer sur une touche pour continuer");
                    break;
                } elseif ($choixCompte === 2) {

                    if ($livretA) {
                        change_color("red");
                        $reponse = strtoupper(readline("Le client n° " . $compteController->getCompte()->getIdClient() . " possède déjà un livret A, appuyer sur une touche"));
                        change_color("");
                        break 2;
                    }
                    $compteController->setType("LivretA");
                    $reponse = (float)(readline("solde du livret A (max 10 000 euros) : "));
                    while (true) {
                        if (!is_numeric($reponse) || $reponse < 0 || $reponse > 10000) {
                            change_color("red");
                            if ($reponse < 0) {
                                $reponse = strtoupper(readline("invalide! : solde négatif impossible!" . PHP_EOL . "solde du livret A (max 10 000 euros) :  "));
                            } else {
                                $reponse = strtoupper(readline("invalide! : appuyer sur une touche : "));
                            }
                            change_color("");
                        } else {
                            break;
                        }
                    }
                    $compteController->setSoldeLivretA($reponse);
                    $comptes[] = $compteController->getCompte();
                    $reponse = readline("appuyer sur une autre touche pour continuer");
                    break;
                } elseif ($choixCompte === 3) {

                    if ($pel) {
                        change_color("red");
                        $reponse = strtoupper(readline("Le client n° " . $compteController->getCompte()->getIdClient() . " possède déjà un PEL, appuyer sur une touche"));
                        change_color("");
                        break 2;
                    }
                    $compteController->setType("PEL");;
                    $reponse = (float)(readline("solde du PEL (max 10 000 euros) : "));
                    while (true) {
                        if (!is_numeric($reponse) || $reponse < 0 || $reponse > 10000) {
                            change_color("red");
                            if ($reponse < 0) {
                                $reponse = strtoupper(readline("invalide! : solde négatif impossible! solde du PEL (max 10 000 euros) : "));
                            } else {
                                $reponse = strtoupper(readline("invalide! : solde du PEL (max 10 000 euros) : "));
                            }
                            change_color("");
                        } else {
                            break;
                        }
                    }
                    $compteController->setSoldePel($reponse);
                    $comptes[] = $compteController->getCompte();
                    $reponse = readline("appuyer sur une autre touche pour continuer");

                    break;
                }
            }

            $compteController->setNumeroCompte($comptes);
            arrayToCsv($comptes, $filename = ROOT_PATH . 'sauv/comptes/comptes.csv', $delimiter = ',', $header = array("numeroCompte", "codeAgence", "idClient", "type", "decouvert", "decouvertMontant", "solde", "soldeLivretA", "soldePel"));
            change_color("green");
            echo ("Le compte n° " . $compteController->getCompte()->getNumeroCompte() . " a bien été créé" . PHP_EOL);
            change_color("");

            $comptes[] = $compteController->getCompte();

            readline("Appuyer sur entrer ...");
            $cptCompte = 0;
            break;
        }
    } elseif ($choixMenu === 4) {

        // Menu 4 : Recherche de compte (numéro de compte)
        $compteController->rechercherCompte($comptes, $clients);
    } elseif ($choixMenu === 5) {

        // Menu 5 : Recherche de client (Nom, Numéro de compte, identifiant de client)
        $clientController->rechercheClientByNomOrNumeroCompteOrId($comptes, $clients);
    } elseif ($choixMenu === 6) {

        // Menu 6 : Afficher la liste des comptes d’un client (identifiant client)
        $clientController->afficherComptesClientById($comptes, $clients);
    } elseif ($choixMenu === 7) {

        // Menu 7 : Imprimer les infos client (identifiant client)
        $clientController->imprimerInfosClients($comptes, $clients);
    } elseif ($choixMenu === 8) {

        // Menu 8 : Simulation des frais de compte
        $compteController->simulerFraisDeCompte($comptes, $clients);
    }
}
