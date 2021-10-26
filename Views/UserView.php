<?php
// User View class
class UserView extends UserController {
    // Register Done method
    public function registerDone() {
        // Sending the JSON to the Front-End
        echo $this->register();
    }
    // Login Done method
    public function loginDone() {
        // Sending the JSON to the Front-End
        echo $this->login();
    }
    // Check Login Session Done method
    public function checkLoginSessionDone() {
        // Sending the JSON to the Front-End
        echo $this->checkLoginSession();
    }
}
?>