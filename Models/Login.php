<?php
// Login class
class Login extends User {
    // Class varaibles
    private int $id;
    private string $username;
    private string $date;
    // Id accessor method
    protected function getId() {
        return $this->id;
    }
    // Username accessor method
    protected function getUsername() {
        return $this->username;
    }
    // Date accessor method
    protected function getDate() {
        return $this->date;
    }
    // Id mutator method
    protected function setId($id) {
        $this->id = $id;
    }
    // Username mutator method
    protected function setUsername($username) {
        $this->username = $username;
    }
    // Date mutator method
    protected function setDate() {
        // Setting the default Timezone to UTC + 4
        date_default_timezone_set("Indian/Mauritius");
        $this->date = date("Y-m-d H:i:s");
    }
    // Insert Login method
    protected function insertLogin() {
        // Preparing the query
        $this->query("INSERT INTO StormySystem.Login (LoginUser, LoginDate) VALUES (:LoginUser, :LoginDate)");
        // Binding the data for security purposes
        $this->bind(":LoginUser", $this->getUsername());
        $this->bind(":LoginDate", $this->getDate());
        // Executing the query
        $this->execute();
    }
    // Track method
    protected function track() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // If-statement to retrieve to the required data
        if ($this->selectUserUsernameOrMailAddress($userJSON->usernameOrMailAddress, $userJSON->usernameOrMailAddress) == $userJSON->usernameOrMailAddress) {
            // Calling Login::setUsername()
            $this->setUsername($this->selectUserUsernameOrMailAddress($userJSON->usernameOrMailAddress, $userJSON->usernameOrMailAddress)[0]['UserUsername']);
            // Calling Login::setDate()
            $this->setDate();
            // Inserting data in the database
            $this->insertLogin();
        } else {
            // Calling Login::setUsername()
            $this->setUsername($this->selectUserUsernameOrMailAddress($userJSON->usernameOrMailAddress, $userJSON->usernameOrMailAddress)[0]['UserUsername']);
            // Calling Login::setDate()
            $this->setDate();
            // Inserting data in the database
            $this->insertLogin();
        }
    }
}
?>