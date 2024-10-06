<?php

change_color("blue");
echo (PHP_EOL . PHP_EOL .
    "Numéro client : " . $client["idClient"] . PHP_EOL .
    "Nom : " . $client["nom"] . PHP_EOL .
    "Prénom : " . $client["prenom"] . PHP_EOL .
    "Mail : " . $client["email"] . PHP_EOL .
    "Date de naissance : " . $client["dateDeNaissance"] . PHP_EOL . PHP_EOL .
    "_______________________" . PHP_EOL .
    "Liste de(s) compte(s) :" . PHP_EOL . PHP_EOL);
change_color("");
if (isset($idClient)) {
    $compteTrouve = 0;
    while (true) {
        foreach ($comptes as $cles => $compte) {
            foreach ($compte as $cle => $val) {
                if ($cle === "idClient" && $val === $idClient) {

                    if ($compte["solde"] != "" && $compte["type"] === "Courant") {
                        change_color("green");
                        echo ("Compte courant numéro : " . $compte["numeroCompte"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $compteTrouve++;
                    }
                    if ($compte["soldeLivretA"] != "" && $compte["type"] === "LivretA") {
                        change_color("green");
                        echo ("Livret A numéro : " . $compte["numeroCompte"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $compteTrouve++;
                    }
                    if ($compte["soldePel"] != "" && $compte["type"] === "PEL") {
                        change_color("green");
                        echo ("Compte épargne logement numéro : " . $compte["numeroCompte"] . PHP_EOL . PHP_EOL);
                        change_color("");
                        $compteTrouve++;
                    }
                }
            }
        }
        if ($compteTrouve === 0) {
            change_color("red");
            echo ("Aucun compte enregistré pour ce client" . PHP_EOL . PHP_EOL);
            change_color("");
            break;
        }
        break;
    }
}
echo (PHP_EOL . PHP_EOL);
