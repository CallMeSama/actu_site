<?php
try {
    // Initialisation du client SOAP
    $client = new SoapClient(null, array(
        'location' => "http://localhost/actu_site/soap_server.php", // Assurez-vous que cette URL est correcte
        'uri'      => "http://localhost/actu_site/soap_server.php",
        'trace'    => 1
    ));

    // Exemple d'authentification d'un utilisateur
    $username = 'admin@gmail.com';
    $password = 'passer';
    $authResult = $client->__soapCall("authenticateUser", array("username" => $username, "password" => $password));
    var_dump($authResult);

    if (isset($authResult['token'])) {
        // Si $authResult est un tableau et le statut est 'success'
        $token = $authResult['token'];
        echo "Authentication successful. Token: " . $token . "\n";
    } else {
        // Gestion de l'échec de l'authentification
        $message = isset($authResult['message']) ? $authResult['message'] : 'Unknown error';
        echo "Authentication failed: " . $message . "\n";
    }
} catch (SoapFault $e) {
    echo "SOAP Error: " . $e->getMessage();
}
