<?php
change_color("blue");
echo (PHP_EOL . PHP_EOL .
    "Numéro client : " . $client["idClient"] . PHP_EOL .
    "Nom : " . $client["nom"] . PHP_EOL .
    "Prénom : " . $client["prenom"] . PHP_EOL .
    "Date de naissance : " . $client["dateDeNaissance"] . PHP_EOL . PHP_EOL);
change_color("");

if (isset($idClient)) {
    while (true) {
        foreach ($comptes as $cles => $compte) {
            foreach ($compte as $cle => $val) {
                if ($cle === "idClient" && $val === $idClient) {
                    if ($compte["solde"] != "" && (int)$compte["numeroCompte"] === $compteRecherche) {
                        change_color("green");
                        echo ("Compte courant : " . $compte["numeroCompte"] . PHP_EOL);
                        echo (" solde actuel : " . (int)$compte["solde"] . " euros." .  PHP_EOL);
                        echo (" solde après " . $duree . " an(s) : " . ((int)$compte["solde"] - ($duree * $fraisTenueCompte)) . " euros." . PHP_EOL);
                        change_color("");
                    }
                    if ($compte["soldeLivretA"] != "" && (int)$compte["numeroCompte"] === $compteRecherche) {
                        change_color("blue");
                        echo ("Livret A : " . $compte["numeroCompte"] . PHP_EOL);
                        echo (" solde actuel : " . (int)$compte["soldeLivretA"] . " euros." .  PHP_EOL);
                        echo (" solde après " . $duree . " an(s) : " . ((int)$compte["soldeLivretA"] - ($duree * $fraisTenueCompte) - ($compte["soldeLivretA"] * 0.1)) . " euros." .  PHP_EOL);
                        change_color("");
                    }
                    if ($compte["soldePel"] != "" && (int)$compte["numeroCompte"] === $compteRecherche) {
                        change_color("purple");
                        echo ("Plan épargne logement : " . $compte["numeroCompte"] . PHP_EOL);
                        echo (" solde actuel : " . (int)$compte["soldePel"] . " euros." .  PHP_EOL);
                        echo (" solde après " . $duree . " an(s) : " . ((int)$compte["soldePel"] - ($duree * $fraisTenueCompte) - ($compte["soldePel"] * 0.025)) . " euros." .  PHP_EOL);
                        change_color("");
                    }
                }
            }
        }
        break;
    }
    echo (PHP_EOL);
}
