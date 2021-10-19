<?php
// Importing Register.html
require_once $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/Pages/Register.html';
// Importing User.php
require $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
// Instantiation User
$User = new User();
// If-Statement to verify whether there is a JSON
if (json_decode(file_get_contents("php://input")) != null) {
    // Calling User::register()
    $User->register();
}
?>