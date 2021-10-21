<?php
// Importing StormySystem.php
require $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
// Instantiating User
$User = new User();
// Instantiating Login
$Login = new Login();
// Instantiating Renderer
$Renderer = new Renderer();
// If-Statement to verify whether there is a JSON
if (json_decode(file_get_contents("php://input")) != null) {
    // If-statement to verify whether the JSON does not have any null value
    if (!empty(json_decode(file_get_contents("php://input"))->usernameOrMailAddress) && !empty(json_decode(file_get_contents("php://input"))->password)) {
        // Calling User::login()
        $User->login();
        // Calling Login::track()
        $Login->track();
    } else {
        // Message to be encoded and sent
        $message = array(
            "success" => "failure",
            "url" => $User->domain . "/StormySystems2/Login",
            "message" => $Renderer->userLoginFormWronglyFilled()
        );
        // Preparing the header for the JSON
        header('Content-Type: application/json');
        // Refreshing the page
        header('refresh:4.2; url=' . $User->domain . '/StormySystems2/Login');
        // Sending the JSON
        echo json_encode($message);
    }
}
?>