<?php
// Importing all the dependencies of PHPMAiler
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/SMTP.php";
// API Class
class API {
    // Class variables
    private $dataSourceName = "mysql:dbname=StormySystem;host=stormysystem.ddns.net:3306";
    private $username = "usernameDBH";
    private $password = "passwordDBH";
    private $databaseHandler;
    private $statement;
    // Constructor method
    public function __construct() {
        $options = array(PDO::ATTR_PERSISTENT=>true, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        try {
            $this->databaseHandler = new PDO($this->dataSourceName, $this->username, $this->password, $options);
        } catch (PDOException $error) {
            echo "Connection Failed: " . $error->getMessage();
        }
    }
    // Bind method
    public function bind($parameter, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($parameter, $value, $type);
    }
    // Query method
    public function query($query) {
        $this->statement = $this->databaseHandler->prepare($query);
    }
    // Execute method
    public function execute() {
        return $this->statement->execute();
    }
    // Result Set method
    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
// Renderer Class
class Renderer {
    // User Register Success method
    public function userRegisterSuccess() {
        return "You have been successfully registered into the system!";
    }
    // User Register Too Young method
    public function userRegisterTooYoung() {
        return "You are too young to be able to use this system!";
    }
    // User Register Username Exists method
    public function userRegisterUsernameExists() {
        return "You already have an account on the system!  You will be redirected to the login page!";
    }
    // User Login User Does Not Exist method
    public function userLoginUserDoesNotExist($user) {
        return $user . "does not exist!";
    }
    // User Login Incorrect Password method
    public function userLoginIncorrectPassword() {
        return "Incorrect Password!";
    }
    // User Login Form Wrongly Filled method
    public function userLoginFormWronglyFilled() {
        return "The form is not filled correctly!";
    }
    // User Check Session Banned User method
    public function userCheckSessionBannedUser() {
        return "You have been banned!  Please consider into contacting an administrator!";
    }
    // User Check Session Cannot Verify Type method
    public function userCheckSessionCannotVerifyType() {
        return "There is an issue with the system.  Please try again later!";
    }
    // User Check Session User Does Not Exist method
    public function userCheckSessionUserDoesNotExist($user) {
        return "{$user} does not exist!";
    }
}
// User Class
class User {
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
    protected $PHPMailer;
    protected $API;
    protected $Renderer;
    // Contructor method
    public function __construct() {
        // Instantiating API
        $this->API = new API();
        // Instantiating Renderer
        $this->Renderer = new Renderer();
        // Instantiating PHPMailer
        $this->PHPMailer = new PHPMailer\PHPMailer\PHPMailer(true);
    }
    // Username accessor method
    public function getUsername() {
        return $this->username;
    }
    // First Name accessor method
    public function getFirstName() {
        return $this->firstName;
    }
    // Last Name accessor method
    public function getLastname() {
        return $this->lastName;
    }
    // Mail Address accessor method
    public function getMailAddress() {
        return $this->mailAddress;
    }
    // Type accessor method
    public function getType() {
        return $this->type;
    }
    // Date Of Birth accessor method
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }
    // Profile Picture accessor method
    public function getProfilePicture() {
        return $this->profilePicture;
    }
    // Password accessor method
    public function getPassword() {
        return $this->password;
    }
    // Username mutator method
    public function setUsername($username) {
        $this->username = $username;
    }
    // First Name mutator method
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    // Last Name mutator method
    public function setLastname($lastName) {
        $this->lastName = $lastName;
    }
    // Mail Address mutator method
    public function setMailAddress($mailAddress) {
        $this->mailAddress = $mailAddress;
    }
    // Type mutator method
    public function setType($type) {
        $this->type = $type;
    }
    // Date Of Birth mutator method
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }
    // Profile Picture mutator method
    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }
    // Password mutator method
    public function setPassword($password) {
        $this->password = $password;
    }
    // Register method
    public function register() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // Preparing the query
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value
        $this->API->bind(":UserUsername", $userJSON->username);
        // Executing the query
        $this->API->execute();
        // If-statement to verify whether the username does not exist in the database
        if (empty($this->API->resultSet())) {
            // Setting the date of birth of the user as the parameter for User::setDateOfBirth()
            $this->setDateOfBirth($userJSON->dateOfBirth);
            // Storing the difference in years.
            $age = date("Y-m-d") - $this->getDateOfBirth();
            // If-statement to verify whether the user has the minimum age to use the system.
            if ($age >= 13) {
                // Setting the password generated as the parameter for the User::setPassword()
                $this->setPassword($this->generatePassword());
                // Storing remaining data from the form
                $this->setUsername($userJSON->username);
                $this->setFirstName($userJSON->firstName);
                $this->setLastName($userJSON->lastName);
                $this->setType(1);
                $this->setMailAddress($userJSON->mailAddress);
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
                // Calling Is SMTP function from PHPMailer.
                $this->PHPMailer->IsSMTP();
                // Assigning "UTF-8" as the value for the charset.
                $this->PHPMailer->CharSet = "UTF-8";
                // Assigning the host for gmail's SMTP.
                $this->PHPMailer->Host = "ssl://smtp.gmail.com";
                // Setting the debug mode to 0.
                $this->PHPMailer->SMTPDebug = 0;
                // Assigning the Port to 465 as GMail uses 465 as it also means that port 465 has been forwarded for its use.
                $this->PHPMailer->Port = 465;
                // Securing the SMTP connection by using SSL.
                $this->PHPMailer->SMTPSecure = 'ssl';
                // Enabling authorization for SMTP.
                $this->PHPMailer->SMTPAuth = true;
                // Ensuring that PHPMailer is called from a .html file.
                $this->PHPMailer->IsHTML(true);
                // Sender's mail address.
                $this->PHPMailer->Username = "username2";
                // Sender's password
                $this->PHPMailer->Password = "password2";
                // Assigning sender as a parameter in the sender's zone.
                $this->PHPMailer->setFrom($this->PHPMailer->Username);
                // Assinging the receiver mail's address which is retrieved from the User class.
                $this->PHPMailer->addAddress($this->getMailAddress());
                $this->PHPMailer->Subject = "Stormy System: Registration Complete!";
                $this->PHPMailer->Body = "Your password is " . $this->getPassword() . ".  Please consider to change your password after logging in!";
                // Sending the mail.
                $this->PHPMailer->send();
                // Message to be encoded and sent
                $message = array(
                    "success" => "success",
                    "url" => $this->domain . "/StormySystems2/Login",
                    "message" => $this->Renderer->userRegisterSuccess()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting towards the login page.
                header("refresh:3.87; url = " . $this->domain . "/StormySystems2/Login");
                // Sending the JSON
                echo json_encode($message);
            } else {
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2",
                    "message" => $this->Renderer->userRegisterTooYoung()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting towards the homepage.
                header("refresh:3.87; url = " . $this->domain . "/StormySystems2");
                // Sending the JSON
                echo json_encode($message);
            }
        } else {
            // Message to be encoded and sent
            $message = array(
                "success" => "failure",
                "url" => $this->domain . "/StormySystems2/Login",
                "message" => $this->Renderer->userRegisterUsernameExists()
            );
            // Preparing the header for the JSON
            header('Content-Type: application/json');
            // Redirecting towards the Login page.
            header("refresh:3.87; url = " . $this->domain . "/StormySystems2/Login");
            // Sending the JSON
            echo json_encode($message);
        }
    }
    // Generate Password method
    public function generatePassword() {
        return uniqid();
    }
    // Login method
    public function login() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // Preparing the query to verify if the username entered exists in the database.
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value returned by the page for security purposes.
        $this->API->bind(":UserUsername", $userJSON->usernameOrMailAddress);
        // Executing the query.
        $this->API->execute();
        // Verifying whether the username exists and in case that it exists, the system will search whether the combination of the username and password is correct but in case that it does not exist, the system will verify whether the mail address exists.
        if (!empty($this->API->resultSet())) {
            // Storing the data needed in the class variables for further processing
            $this->setUsername($this->API->resultSet()[0]['UserUsername']);
            // If-statement to verify whether the password is the same from the form in the database
            if ($userJSON->password == $this->API->resultSet()[0]['UserPassword']) {
                // Verifying whether the profile picture of the user exists
                if ($this->API->resultSet()[0]['UserProfilePicture'] != null) {
                    // Storing the data retrieved from the database in the class variables
                    $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                    $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                    $this->setPassword($this->API->resultSet()[0]['UserPassword']);
                    $this->setType($this->API->resultSet()[0]['UserType']);
                    $this->setProfilePicture($this->API->resultSet()[0]['UserProfilePicture']);
                    $this->setFirstName($this->API->resultSet()[0]['UserFirstName']);
                    $this->setLastName($this->API->resultSet()[0]['UserLastName']);
                    $this->setDateOfBirth($this->API->resultSet()[0]['UserDateOfBirth']);
                    // Starting session
                    session_start();
                    // Assigning the Session variable to be the username of the user
                    $_SESSION['username'] = $this->getUsername();
                    // Checking the session
                    $this->checkLoginSession();
                } else {
                    // Storing the data retrieved from the database in the class variables
                    $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                    $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                    $this->setPassword($this->API->resultSet()[0]['UserPassword']);
                    $this->setType($this->API->resultSet()[0]['UserType']);
                    $this->setProfilePicture("null");
                    $this->setFirstName($this->API->resultSet()[0]['UserFirstName']);
                    $this->setLastName($this->API->resultSet()[0]['UserLastName']);
                    $this->setDateOfBirth($this->API->resultSet()[0]['UserDateOfBirth']);
                    // Starting session
                    session_start();
                    // Assigning the Session variable to be the username of the user
                    $_SESSION['username'] = $this->getUsername();
                    // Checking the session
                    $this->checkLoginSession();
                }
            } else {
                // Setting the class variables
                $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2/Login",
                    "message" => $this->Renderer->userLoginIncorrectPassword()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Sending the JSON
                echo json_encode($message);
            }
        } else {
            // Preparing the query to verify if the mail address entered exists in the database.
            $this->API->query("SELECT * FROM StormySystem.User WHERE UserMailAddress = :UserMailAddress");
            // Binding the value returned by the page for security purposes.
            $this->API->bind(":UserMailAddress", $userJSON->usernameOrMailAddress);
            // Executing the query.
            $this->API->execute();
            // Verifying whether the mail address exists and in case that it exists, the system will search whether the combination of the mail address and password is correct but in case that it does not exist, the system will refresh.
            if (!empty($this->API->resultSet())) {
                // Storing the data needed in the class variables for further processing
                $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                // If-statement to verify whether the password is the same as the password saved in the database
                if ($userJSON->password == $this->API->resultSet()[0]['UserPassword']) {
                    // Verifying whether the profile picture of the user exists
                    if ($this->API->resultSet()[0]['UserProfilePicture'] != null) {
                        // Storing the data retrieved from the database in the class variables
                        $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                        $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                        $this->setPassword($this->API->resultSet()[0]['UserPassword']);
                        $this->setType($this->API->resultSet()[0]['UserType']);
                        $this->setProfilePicture($this->API->resultSet()[0]['UserProfilePicture']);
                        $this->setFirstName($this->API->resultSet()[0]['UserFirstName']);
                        $this->setLastName($this->API->resultSet()[0]['UserLastName']);
                        $this->setDateOfBirth($this->API->resultSet()[0]['UserDateOfBirth']);
                        // Starting session
                        session_start();
                        // Assigning the Session variable to be the username of the user
                        $_SESSION['username'] = $this->getUsername();
                        // Checking the session
                        $this->checkLoginSession();
                    } else {
                        // Storing the data retrieved from the database in the class variables
                        $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                        $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                        $this->setPassword($this->API->resultSet()[0]['UserPassword']);
                        $this->setType($this->API->resultSet()[0]['UserType']);
                        $this->setProfilePicture("null");
                        $this->setFirstName($this->API->resultSet()[0]['UserFirstName']);
                        $this->setLastName($this->API->resultSet()[0]['UserLastName']);
                        $this->setDateOfBirth($this->API->resultSet()[0]['UserDateOfBirth']);
                        // Starting session
                        session_start();
                        // Assigning the Session variable to be the username of the user
                        $_SESSION['username'] = $this->getUsername();
                        // Checking the session
                        $this->checkLoginSession();
                    }
                } else {
                    // Setting the class variables
                    $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                    $this->setUsername($this->API->resultSet()[0]['UserUsername']);
                    // Message to be encoded and sent
                    $message = array(
                        "success" => "failure",
                        "url" => $this->domain . "/StormySystems2/Login",
                        "message" => $this->Renderer->userLoginIncorrectPassword()
                    );
                    // Preparing the header for the JSON
                    header('Content-Type: application/json');
                    // Sending the JSON
                    echo json_encode($message);
                }
            } else {
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2/Login",
                    "message" => $this->Renderer->userLoginUserDoesNotExist($userJSON->usernameOrMailAddress)
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Refreshing the page
                header('refresh:4.2; url=' . $this->domain . '/StormySystems2/Login');
                // Sending the JSON
                echo json_encode($message);
            }
        }
    }
    // Check Login Session method
    public function checkLoginSession() {
        // If-statement to verify whether the Session variable is the User's Username
        if ($_SESSION["username"] == $this->getUsername()) {
            // If-statement to verify the Type of the User
            if ($this->getType() == 0) {
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2",
                    "message" => $this->Renderer->userCheckSessionBannedUser()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting the user towards the Main Portal
                header('refresh:4.2; url=' . $this->domain . '/StormySystems2');
                // Sending the JSON
                echo json_encode($message);
                // Calling PHPMailer::IsSMTP()
                $this->PHPMailer->IsSMTP();
                // Setting the charset to be UTF-8
                $this->PHPMailer->CharSet = "UTF-8";
                // Setting the host according to the Mail service provider
                $this->PHPMailer->Host = "ssl://smtp.gmail.com";
                // Setting the SMTP Debugging mode to off
                $this->PHPMailer->SMTPDebug = 0;
                // Setting the port of the mail service provider to TCP 465 port
                $this->PHPMailer->Port = 465;
                // Setting the SMTP Secure mode to SSL connection
                $this->PHPMailer->SMTPSecure = 'ssl';
                // Enablig the SMTP Authorization mode
                $this->PHPMailer->SMTPAuth = true;
                // Assuring that the mail is sent from HTML mode
                $this->PHPMailer->IsHTML(true);
                // Setting the sender's mail address
                $this->PHPMailer->Username = "username2";
                // Setting the sender's password
                $this->PHPMailer->Password = "password2";
                // Assigning the sender's mail address from PHPMailer::Username
                $this->PHPMailer->setFrom($this->Mail->Username);
                // Assigning the recipient address from User::getMailAddress()
                $this->PHPMailer->addAddress($this->getMailAddress());
                // Setting the subject
                $this->PHPMailer->Subject = "Stormy System: Ban Notification";
                // Setting the body
                $this->PHPMailer->Body = "You are currently banned from the system!  Before, you can actually get accessed to the system once again, you will have to get it unban by contacting an administrator.";
                // Sending the mail
                $this->PHPMailer->send();
            } else if ($this->getType() == 1) {
                // Message to be encoded and sent
                $message = array(
                    "success" => "",
                    "url" => $this->domain . "/StormySystems2/Admin",
                    "message" => ""
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting the user towards the Public portal
                header('Location:' . $this->domain . '/StormySystems2/Admin');
                // Sending the JSON
                echo json_encode($message);
            } else {
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2/Login",
                    "message" => $this->Renderer->userCheckSessionCannotVerifyType()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Refreshing the page
                header('refresh:4.2;');
                // Sending the JSON
                echo json_encode($message);
            }
        } else {
            // Message to be encoded and sent
            $message = array(
                "success" => "failure",
                "url" => $this->domain . "/StormySystems2",
                "message" => $this->Renderer->userCheckSessionUserDoesNotExist($this->getUsername())
            );
            // Preparing the header for the JSON
            header('Content-Type: application/json');
            // Redirecting the user towards the homepage
            header('refresh:4.2; url=' . $this->domain . '/StormySystems2');
            // Sending the JSON
            echo json_encode($message);
        }
    }
}
// Login class
class Login extends User {
    // Class varaibles
    private int $id;
    private string $user;
    private string $date;
    // Constructor method
    public function __construct() {
        // Instantiating API
        $this->API = new API();
    }
    // Id accessor method
    public function getId() {
        return $this->id;
    }
    // User accessor method
    public function getUser() {
        return $this->user;
    }
    // Date accessor method
    public function getDate() {
        return $this->date;
    }
    // Id mutator method
    public function setId($id) {
        $this->id = $id;
    }
    // User mutator method
    public function setUser($user) {
        $this->user = $user;
    }
    // Date mutator method
    public function setDate() {
        // Setting the default Timezone to UTC + 4
        date_default_timezone_set("Indian/Mauritius");
        $this->date = date("Y-m-d H:i:s");
    }
    // Track method
    public function track() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // Preparing the query
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername OR UserMailAddress = :UserMailAddress");
        // Binding the data for security reasons
        $this->API->bind(":UserUsername", $userJSON->usernameOrMailAddress);
        $this->API->bind(":UserMailAddress", $userJSON->usernameOrMailAddress);
        // Executing the query
        $this->API->execute();
        // If-statement to retrieve to the required data
        if ($this->API->resultSet()[0]['UserUsername'] == $userJSON->usernameOrMailAddress) {
            // Calling Login::setUser()
            $this->setUser($this->API->resultSet()[0]['UserUsername']);
            // Calling Login::setDate()
            $this->setDate();
            // Preparing the query
            $this->API->query("INSERT INTO StormySystem.Login (LoginUser, LoginDate) VALUES (:LoginUser, :LoginDate)");
            // Binding the data for security purposes
            $this->API->bind(":LoginUser", $this->getUser());
            $this->API->bind(":LoginDate", $this->getDate());
            // Executing the query
            $this->API->execute();
        } else {
            // Calling Login::setUser()
            $this->setUser($this->API->resultSet()[0]['UserUsername']);
            // Calling Login::setDate()
            $this->setDate();
            // Preparing the query
            $this->API->query("INSERT INTO StormySystem.Login (LoginUser, LoginDate) VALUES (:LoginUser, :LoginDate)");
            // Binding the data for security purposes
            $this->API->bind(":LoginUser", $this->getUser());
            $this->API->bind(":LoginDate", $this->getDate());
            // Executing the query
            $this->API->execute();
        }
    }
}
?>