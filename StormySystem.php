<?php
// Importing all the dependencies of PHPMAiler
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/SMTP.php";
// API Class
class API {
    // Class variables
    private $dataSourceName = "mysql:dbname=StormySystem;host=stormysystem.ddns.net:3306";
    private $username = "username1";
    private $password = "password1";
    private $databaseHandler;
    private $statement;
    // Constructor method
    public function __construct() {
        $options = array(PDO::ATTR_PERSISTENT=>true, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        try {
            $this->databaseHandler = new PDO($this->dataSourceName, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
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
    // User Register Username Exists method
    public function userRegisterUsernameExists() {
        return "<h1 id='userRegisterUsernameExists'>You already have an account on the system!  You will be redirected to the login page!</h1>";
    }
    // User Register Too Young method
    public function userRegisterTooYoung() {
        return "<h1 id='userRegisterTooYoung'>You are too young to use this system.  Please come back when you are older!</h1>";
    }
    // User Register Success method
    public function userRegisterSuccess() {
        return "<h1 id='userRegisterSuccess'>You have been registered into the system, you will be redirected to the login page.</h1>";
    }
    // User Login User Does Not Exist method
    public function userLoginUserDoesNotExist($user) {
        return "<h1 id='userLoginUserDoesNotExist'>{$user} does not exist!</h1>";
    }
    // User Login Incorrect Password method
    public function userLoginIncorrectPassword() {
        return "
        <div id='userLoginIncorrectPassword'>
            <h1>Incorrect Password!</h1>
            <form method='post'>
                <input type='submit' value='Reset Password' name='resetPassword' />
            </form>
        </div>";
    }
    // User Check Session Banned User method
    public function userCheckSessionBannedUser() {
        return "<h1 id='userCheckSessionBannedUser'>You have been banned!  Please consider into contacting an administrator!</h1>";
    }
    // User Check Session Cannot Verify Type method
    public function userCheckSessionCannotVerifyType() {
        return "<h1 id='userCheckSessionCannotVerifyType'>There is an issue with the system.  Please try again later!</h1>";
    }
    // User Check Session User Does Not Exist method
    public function userCheckSessionUserDoesNotExist($user) {
        return "<h1 id='userCheckSessionUserDoesNotExist'>{$user} does not exist!</h1>";
    }
    // User Reset Password Password Changed method
    public function userResetPasswordPasswordChanged() {
        return "<h1 id='userResetPasswordPasswordChanged'>Your password has been changed!</h1>";
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
    // public string $domain = "http://stormy-systems.herokuapp.com/";
    public string $domain = "http://stormysystem.ddns.net/";
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
        // Preparing the query
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value
        $this->API->bind(":UserUsername", $_POST["username"]);
        // Executing the query
        $this->API->execute();
        // If-statement to verify whether the username does not exist in the database
        if (empty($this->API->resultSet())) {
            // Setting the date of birth of the user as the parameter for User::setDateOfBirth()
            $this->setDateOfBirth($_POST['dateOfBirth']);
            // Storing the difference in years.
            $age = date("Y-m-d") - $this->getDateOfBirth();
            // If-statement to verify whether the user has the minimum age to use the system.
            if ($age >= 13) {
                // Setting the password generated as the parameter for the User::setPassword()
                $this->setPassword($this->generatePassword());
                // Storing remaining data from the form
                $this->setUsername($_POST['username']);
                $this->setFirstName($_POST['firstName']);
                $this->setLastName($_POST['lastName']);
                $this->setType(1);
                $this->setMailAddress($_POST['mailAddress']);
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
                // Printing Message
                echo $this->Renderer->userRegisterSuccess();
                // Redirecting towards the login page.
                header("refresh:6.27; url = " . $this->domain . "/StormySystems2/Login");
            } else {
                // Printing the message
                echo $this->Renderer->userRegisterTooYoung();
                // Redirecting towards the homepage.
                header("refresh:6.27; url = " . $this->domain . "/StormySystems2");
            }
        } else {
            // Printing the message
            echo $this->Renderer->userRegisterUsernameExists();
            // Redirecting towards the Login page.
            header("refresh:6.27; url = " . $this->domain . "/StormySystems2/Login");
        }
    }
    // Generate Password method
    public function generatePassword() {
        return uniqid();
    }
    // Login method
    public function login() {
        // Preparing the query to verify if the username entered exists in the database.
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value returned by the page for security purposes.
        $this->API->bind(":UserUsername", $_POST['usernameOrMailAddress']);
        // Executing the query.
        $this->API->execute();
        // Verifying whether the username exists and in case that it exists, the system will search whether the combination of the username and password is correct but in case that it does not exist, the system will verify whether the mail address exists.
        if (!empty($this->API->resultSet())) {
            // Storing the data needed in the class variables for further processing
            $this->setUsername($this->API->resultSet()[0]['UserUsername']);
            // If-statement to verify whether the password is the same from the form in the database
            if ($_POST['password'] == $this->API->resultSet()[0]['UserPassword']) {
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
                // Printing the message
                echo $this->Renderer->userLoginIncorrectPassword();
            }
        } else {
            // Preparing the query to verify if the mail address entered exists in the database.
            $this->API->query("SELECT * FROM StormySystem.User WHERE UserMailAddress = :UserMailAddress");
            // Binding the value returned by the page for security purposes.
            $this->API->bind(":UserMailAddress", $_POST['usernameOrMailAddress']);
            // Executing the query.
            $this->API->execute();
            // Verifying whether the mail address exists and in case that it exists, the system will search whether the combination of the mail address and password is correct but in case that it does not exist, the system will refresh.
            if (!empty($this->API->resultSet())) {
                // Storing the data needed in the class variables for further processing
                $this->setMailAddress($this->API->resultSet()[0]['UserMailAddress']);
                // If-statement to verify whether the password is the same as the password saved in the database
                if ($_POST['password'] == $this->API->resultSet()[0]['UserPassword']) {
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
                    // Printing the message
                    echo $this->Renderer->userLoginIncorrectPassword();
                }
            } else {
                // Printing the message
                echo $this->Renderer->userLoginUserDoesNotExist($_POST['usernameOrMailAddress']);
                // Refreshing the page
                header('refresh:1.6; url=' . $this->domain . '/StormySystems2/Login');
            }
        }
    }
    // Check Login Session method
    public function checkLoginSession() {
        // If-statement to verify whether the Session variable is the User's Username
        if ($_SESSION["username"] == $this->getUsername()) {
            // If-statement to verify the Type of the User
            if ($this->getType() == 0) {
                // Printing message
                echo $this->Renderer->userCheckSessionBannedUser();
                // Calling PHPMailer::IsSMTP()
                $this->Mail->IsSMTP();
                // Setting the charset to be UTF-8
                $this->Mail->CharSet = "UTF-8";
                // Setting the host according to the Mail service provider
                $this->Mail->Host = "ssl://smtp.gmail.com";
                // Setting the SMTP Debugging mode to off
                $this->Mail->SMTPDebug = 0;
                // Setting the port of the mail service provider to TCP 465 port
                $this->Mail->Port = 465;
                // Setting the SMTP Secure mode to SSL connection
                $this->Mail->SMTPSecure = 'ssl';
                // Enablig the SMTP Authorization mode
                $this->Mail->SMTPAuth = true;
                // Assuring that the mail is sent from HTML mode
                $this->Mail->IsHTML(true);
                // Setting the sender's mail address
                $this->Mail->Username = "username2";
                // Setting the sender's password
                $this->Mail->Password = "password2";
                // Assigning the sender's mail address from PHPMailer::Username
                $this->Mail->setFrom($this->Mail->Username);
                // Assigning the recipient address from User::getMailAddress()
                $this->Mail->addAddress($this->getMailAddress());
                // Setting the subject
                $this->Mail->Subject = "Stormy System: Ban Notification";
                // Setting the body
                $this->Mail->Body = "You are currently banned from the system!  Before, you can actually get accessed to the system once again, you will have to get it unban by contacting an administrator.";
                // Sending the mail
                $this->Mail->send();
                // Redirecting the user towards the Main Portal
                header('refresh:7.2; url=' . $this->domain . '/StormySystems2');
            } else if ($this->getType() == 1) {
                // Redirecting the user towards the Public portal
                header('Location:' . $this->domain . '/StormySystems2/Public');
            } else if ($this->getType() == 2) {
                // Redirecting the user towards the Member Portal
                header('Location:' . $this->domain . '/StormySystems2/Member');
            } else if ($this->getType() == 3) {
                // Redirecting the user towards the Workplace Portal
                header('Location:' . $this->domain . '/StormySystems2/Workplace');
            } else if ($this->getType() == 4) {
                // Redirecting the user towards the Admin Portal
                header('Location:' . $this->domain . '/StormySystems2/Admin');
            } else {
                // Printing the message
                echo $this->Renderer->userCheckSessionCannotVerifyType();
                // Refreshing the page
                header('refresh:4.2;');
            }
        } else {
            // Printing the message
            echo $this->Renderer->userCheckSessionUserDoesNotExist($this->getUsername());
            // Redirecting the user towards the homepage
            header('refresh:4.2; url=' . $this->domain . '/StormySystems2');
        }
    }
    // Reset Password method
    public function resetPassword() {
        // Preparing the query
        $this->API->query("SELECT * FROM StormySystem.User WHERE UserUsername = :UserUsername");
        // Binding the value
        $this->API->bind(":UserUsername", $this->getUsername());
        // Executing the query
        $this->API->execute();
        // Changing the password
        $this->setPassword($this->generatePassword());
        // Preparing the query
        $this->API->query("UPDATE StormySystem.User SET UserPassword = :UserPassword WHERE UserMailAddress = :UserMailAddress");
        // Binding the values
        $this->API->bind(":UserPassword", $this->getPassword());
        $this->API->bind(":UserMailAddress", $this->API->resultSet()[0]['UserMailAddress']);
        // Executing the query
        $this->API->execute();
        // Printing message
        echo $this->Renderer->userResetPasswordPasswordChanged();
        // Calling PHPMailer::IsSMTP()
        $this->Mail->IsSMTP();
        // Setting the charset to be UTF-8
        $this->Mail->CharSet = "UTF-8";
        // Setting the host according to the Mail service provider
        $this->Mail->Host = "ssl://smtp.gmail.com";
        // Setting the SMTP Debugging mode to off
        $this->Mail->SMTPDebug = 0;
        // Setting the port of the mail service provider to TCP 465 port
        $this->Mail->Port = 465;
        // Setting the SMTP Secure mode to SSL connection
        $this->Mail->SMTPSecure = 'ssl';
        // Enablig the SMTP Authorization mode
        $this->Mail->SMTPAuth = true;
        // Assuring that the mail is sent from HTML mode
        $this->Mail->IsHTML(true);
        // Setting the sender's mail address
        $this->Mail->Username = "username2";
        // Setting the sender's password
        $this->Mail->Password = "password2";
        // Assigning the sender's mail address from PHPMailer::Username
        $this->Mail->setFrom($this->Mail->Username);
        // Assigning the recipient address from User::getMailAddress()
        $this->Mail->addAddress($this->getMailAddress());
        // Setting the subject
        $this->Mail->Subject = "Stormy System: Reset Password";
        // Setting the body
        $this->Mail->Body = "Your password is " . $this->getPassword() . ".  Please consider to change your password after logging in!";
        // Sending the mail
        $this->Mail->send();
        // Redirecting the user towards the Main Portal
        header('refresh:5; url=' . $this->domain . '/StormySystems2/Login');
    }
}
// Music Class
class Music {
    // Class variables
    private int $id;
    private string $title;
    private string $author;
    private string $dateUploaded;
    private int $downloads;
    private int $listens;
    private string $uploader;
    private int $likes;
    private int $hates;
    protected $User;
    // Constructor method
    public function __construct() {
        // Instantiating User
        $this->User = new User();
    }
    // ID accessor method
    public function getId() {
        return $this->id;
    }
    // Title accessor method
    public function getTitle() {
        return $this->title;
    }
    // Author accessor method
    public function getAuthor() {
        return $this->author;
    }
    // Date Uploaded accessor method
    public function getDateUploaded() {
        return $this->dateUploaded;
    }
    // Downloads accessor method
    public function getDownloads() {
        return $this->downloads;
    }
    // Listens accessor method
    public function getListens() {
        return $this->listens;
    }
    // Uploader accessor method
    public function getUploader() {
        return $this->uploader;
    }
    // Likes accessor method
    public function getLikes() {
        return $this->likes;
    }
    // Hates accessor method
    public function getHates() {
        return $this->hates;
    }
    // ID mutator method
    public function setId($id) {
        $this->id = $id;
    }
    // Title mutator method
    public function setTitle($title) {
        $this->title = $title;
    }
    // Author mutator method
    public function setAuthor($author) {
        $this->author = $author;
    }
    // Date Uploaded mutator method
    public function setDateUploaded($dateUploaded) {
        $this->dateUploaded = $dateUploaded;
    }
    // Downloads mutator method
    public function setDownloads($downloads) {
        $this->downloads = $downloads;
    }
    // Listens mutator method
    public function setListens($listens) {
        $this->listens = $listens;
    }
    // Uploader mutator method
    public function setUploader($uploader) {
        $this->uploader = $uploader;
    }
    // Likes mutator method
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    // Hates mutator method
    public function setHates($hates) {
        $this->hates = $hates;
    }
}
// Video Class
class Video {
    // Class variables
    private int $id;
    private string $title;
    private string $author;
    private string $dateUploaded;
    private int $downloads;
    private int $views;
    private string $uploader;
    private int $likes;
    private int $hates;
    protected $User;
    // Constructor method
    public function __construct() {
        // Instantiating User
        $this->User = new User();
    }
    // ID accessor method
    public function getId() {
        return $this->id;
    }
    // Title accessor method
    public function getTitle() {
        return $this->title;
    }
    // Author accessor method
    public function getAuthor() {
        return $this->author;
    }
    // Date Uploaded accessor method
    public function getDateUploaded() {
        return $this->dateUploaded;
    }
    // Downloads accessor method
    public function getDownloads() {
        return $this->downloads;
    }
    // Views accessor method
    public function getViews() {
        return $this->views;
    }
    // Uploader accessor method
    public function getUploader() {
        return $this->uploader;
    }
    // Likes accessor method
    public function getLikes() {
        return $this->likes;
    }
    // Hates accessor method
    public function getHates() {
        return $this->hates;
    }
    // ID mutator method
    public function setId($id) {
        $this->id = $id;
    }
    // Title mutator method
    public function setTitle($title) {
        $this->title = $title;
    }
    // Author mutator method
    public function setAuthor($author) {
        $this->author = $author;
    }
    // Date Uploaded mutator method
    public function setDateUploaded($dateUploaded) {
        $this->dateUploaded = $dateUploaded;
    }
    // Downloads mutator method
    public function setDownloads($downloads) {
        $this->downloads = $downloads;
    }
    // Views mutator method
    public function setViews($views) {
        $this->views = $views;
    }
    // Uploader mutator method
    public function setUploader($uploader) {
        $this->uploader = $uploader;
    }
    // Likes mutator method
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    // Hates mutator method
    public function setHates($hates) {
        $this->hates = $hates;
    }
}
// Design Class
class Design {
    // Class variables
    private int $id;
    private string $title;
    private string $author;
    private string $dateUploaded;
    private int $downloads;
    private int $views;
    private string $uploader;
    private int $likes;
    private int $hates;
    protected $User;
    // Constructor method
    public function __construct() {
        // Instantiating User
        $this->User = new User();
    }
    // ID accessor method
    public function getId() {
        return $this->id;
    }
    // Title accessor method
    public function getTitle() {
        return $this->title;
    }
    // Author accessor method
    public function getAuthor() {
        return $this->author;
    }
    // Date Uploaded accessor method
    public function getDateUploaded() {
        return $this->dateUploaded;
    }
    // Downloads accessor method
    public function getDownloads() {
        return $this->downloads;
    }
    // Views accessor method
    public function getViews() {
        return $this->views;
    }
    // Uploader accessor method
    public function getUploader() {
        return $this->uploader;
    }
    // Likes accessor method
    public function getLikes() {
        return $this->likes;
    }
    // Hates accessor method
    public function getHates() {
        return $this->hates;
    }
    // ID mutator method
    public function setId($id) {
        $this->id = $id;
    }
    // Title mutator method
    public function setTitle($title) {
        $this->title = $title;
    }
    // Author mutator method
    public function setAuthor($author) {
        $this->author = $author;
    }
    // Date Uploaded mutator method
    public function setDateUploaded($dateUploaded) {
        $this->dateUploaded = $dateUploaded;
    }
    // Downloads mutator method
    public function setDownloads($downloads) {
        $this->downloads = $downloads;
    }
    // Views mutator method
    public function setViews($views) {
        $this->views = $views;
    }
    // Uploader mutator method
    public function setUploader($uploader) {
        $this->uploader = $uploader;
    }
    // Likes mutator method
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    // Hates mutator method
    public function setHates($hates) {
        $this->hates = $hates;
    }
}
// Application Class
class Application {
    // Class variables
    private int $id;
    private string $title;
    private string $author;
    private string $dateDeployed;
    private int $likes;
    private int $hates;
    protected $User;
    // Constructor method
    public function __construct() {
        // Instantiating User
        $this->User = new User();
    }
    // ID accessor method
    public function getId() {
        return $this->id;
    }
    // Title accessor method
    public function getTitle() {
        return $this->title;
    }
    // Author accessor method
    public function getAuthor() {
        return $this->author;
    }
    // Date Deployed accessor method
    public function getDateDeployed() {
        return $this->dateDeployed;
    }
    // Likes accessor method
    public function getLikes() {
        return $this->likes;
    }
    // Hates accessor method
    public function getHates() {
        return $this->hates;
    }
    // ID mutator method
    public function setId($id) {
        $this->id = $id;
    }
    // Title mutator method
    public function setTitle($title) {
        $this->title = $title;
    }
    // Author mutator method
    public function setAuthor($author) {
        $this->author = $author;
    }
    // Date Deployed mutator method
    public function setDateDeployed($dateDeployed) {
        $this->dateDeployed = $dateDeployed;
    }
    // Likes mutator method
    public function setLikes($likes) {
        $this->likes = $likes;
    }
    // Hates mutator method
    public function setHates($hates) {
        $this->hates = $hates;
    }
}
// Activity Class
class Activity {
    // Class variables
    private int $id;
    private string $action;
    private int $user;
    private string $time;
    private string $date;
    protected $Music;
    protected $Video;
    protected $Design;
    protected $Application;
    // Constructor method
    public function __construct() {
        // Instantiating Music
        $this->Music = new Music();
        // Instantiating Video
        $this->Video = new Video();
        // Instantiating Design
        $this->Design = new Design();
        // Instantiating Application
        $this->Application = new Application();
    }
    // ID accessor method
    public function getId() {
        return $this->id;
    }
    // Action accessor method
    public function getAction() {
        return $this->action;
    }
    // User accessor method
    public function getUser() {
        return $this->user;
    }
    // Time accessor method
    public function getTime() {
        return $this->time;
    }
    // Date accessor method
    public function getDate() {
        return $this->date;
    }
}
?>