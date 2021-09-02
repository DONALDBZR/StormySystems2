<?php
// Importing all the dependencies of PHPMAiler
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/Exception.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/StormySystems2/PHPMailer/src/SMTP.php";
// API Class
class API {
    // Class variables
    private $dataSourceName = "mysql:dbname=StormySystem;host=127.0.0.1:3306";
    private $username = "root";
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