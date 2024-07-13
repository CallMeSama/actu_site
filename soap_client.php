<?php

try {
    // Initialisation du client SOAP
    $client = new SoapClient('http://localhost/actu_site/server.wsdl');

    // Définition du token pour l'authentification
    $token = 'YOUR_TOKEN_HERE';

    // Appel de la méthode listUsers avec le token
    $response = $client->listUsers(['token' => $token]);

    // Vérification du type de réponse
    if (is_object($response) && isset($response->users)) {
        // Accès aux propriétés des objets utilisateurs
        foreach ($response->users as $user) {
            echo "ID: " . $user->id . "\n";
            echo "Username: " . $user->username . "\n";
            echo "Role: " . $user->role . "\n";
            echo "Password: " . $user->password . "\n\n";
        }
    } else {
        echo "Aucune donnée utilisateur trouvée.";
    }
} catch (SoapFault $e) {
    echo "SOAP Fault: " . $e->getMessage() . "\n";
    echo "Details: " . print_r($e, true);
}
