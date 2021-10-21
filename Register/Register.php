<?php
// Importing StormySystem.php
require $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
// Instantiating User
$User = new User();
// Instantiating Renderer
$Renderer = new Renderer();
// If-Statement to verify whether there is a JSON
if (json_decode(file_get_contents("php://input")) != null) {
    // If-statement to verify whether the JSON does not have any null value
    if (!empty(json_decode(file_get_contents("php://input"))->username) && !empty(json_decode(file_get_contents("php://input"))->mailAddress) && !empty(json_decode(file_get_contents("php://input"))->firstName) && !empty(json_decode(file_get_contents("php://input"))->lastName) && !empty(json_decode(file_get_contents("php://input"))->dateOfBirth)) {
        // Calling User::register()
        $User->register();
    } else {
        // Message to be encoded and sent
        $message = array(
            "success" => "failure",
            "url" => $User->domain . "/StormySystems2/Register",
            "message" => $Renderer->userRegisterFormWronglyFilled()
        );
        // Preparing the header for the JSON
        header('Content-Type: application/json');
        // Redirecting towards the Login page.
        header("refresh:3.87; url = " . $User->domain . "/StormySystems2/Register");
        // Sending the JSON
        echo json_encode($message);
    }
}
?>