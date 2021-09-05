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
// Activities Class
class Activities {
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