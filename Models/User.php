<?php
// Using PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
// Importing all the dependencies of PHPMAiler
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/SMTP.php";
// User class
class User extends API {
    // Class variables
    private string $username;
    private string $firstName;
    private string $lastName;
    private string $mailAddress;
    private int $type;
    private string $dateOfBirth;
    private string $profilePicture;
    private string $password;
    public string $domain = "http://stormysystem.ddns.net";
    protected PHPMailer $PHPMailer;
    protected Renderer $Renderer;
    // Username accessor method
    protected function getUsername() {
        return $this->username;
    }
    // First Name accessor method
    protected function getFirstName() {
        return $this->firstName;
    }
    // Last Name accessor method
    protected function getLastname() {
        return $this->lastName;
    }
    // Mail Address accessor method
    protected function getMailAddress() {
        return $this->mailAddress;
    }
    // Type accessor method
    protected function getType() {
        return $this->type;
    }
    // Date Of Birth accessor method
    protected function getDateOfBirth() {
        return $this->dateOfBirth;
    }
    // Profile Picture accessor method
    protected function getProfilePicture() {
        return $this->profilePicture;
    }
    // Password accessor method
    protected function getPassword() {
        return $this->password;
    }
    // Username mutator method
    protected function setUsername($username) {
        $this->username = $username;
    }
    // First Name mutator method
    protected function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    // Last Name mutator method
    protected function setLastname($lastName) {
        $this->lastName = $lastName;
    }
    // Mail Address mutator method
    protected function setMailAddress($mailAddress) {
        $this->mailAddress = $mailAddress;
    }
    // Type mutator method
    protected function setType($type) {
        $this->type = $type;
    }
    // Date Of Birth mutator method
    protected function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }
    // Profile Picture mutator method
    protected function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }
    // Password mutator method
    protected function setPassword($password) {
        $this->password = $password;
    }
    // Select User Username method
    protected function selectUserUsername($username) {
        // Preparing the query
        $this->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value
        $this->bind(":UserUsername", $username);
        // Executing the query
        $this->execute();
        // Returning the results from the query
        return $this->resultSet();
    }
    // Insert User method
    protected function insertUser() {
        // Preparing the query
        $this->API->query("INSERT INTO StormySystem.User (UserDateOfBirth, UserUsername, UserFirstName, UserLastName, UserType, UserMailAddress, UserPassword) VALUES (:UserDateOfBirth, :UserUsername, :UserFirstName, :UserLastName, :UserType, :UserMailAddress, :UserPassword)");
        // Binding the values
        $this->API->bind(":UserDateOfBirth", $this->getDateOfBirth());
        $this->API->bind(":UserUsername", $this->getUsername());
        $this->API->bind(":UserFirstName", $this->getFirstName());
        $this->API->bind(":UserLastName", $this->getLastName());
        $this->API->bind(":UserType", $this->getType());
        $this->API->bind(":UserMailAddress", $this->getMailAddress());
        $this->API->bind(":UserPassword", $this->getPassword());
        // Executing the query
        $this->API->execute();
    }
    // Generate Password method
    protected function generatePassword() {
        return uniqid();
    }
    // Select User MailAddress method
    protected function selectUserMailAddress($mailAddress) {
        // Preparing the query
        $this->query("SELECT * FROM StormySystem.User WHERE UserMailAddress = :UserMailAddress");
        // Binding the value
        $this->bind(":UserMailAddress", $mailAddress);
        // Executing the query
        $this->execute();
        // Returning the results from the query
        return $this->resultSet();
    }
    // Select User Username Or Mail Address method
    protected function selectUserUsernameOrMailAddress($username, $mailAddress) {
        // Preparing the query
        $this->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername OR UserMailAddress = :UserMailAddress");
        // Binding the data for security reasons
        $this->bind(":UserUsername", $username);
        $this->bind(":UserMailAddress", $mailAddress);
        // Executing the query
        $this->execute();
        // Returning the results from the query
        return $this->resultSet();
    }
}
?>