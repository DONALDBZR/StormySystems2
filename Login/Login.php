<?php
// Importing StormySystem.php
require $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
// Instantiating User
$User = new User();
// Instantiating Login
$Login = new Login();
// If-Statement to verify whether there is a JSON
if (json_decode(file_get_contents("php://input")) != null) {
    // Calling User::login()
    $User->login();
    // Calling Login::track()
    $Login->track();
}
?>