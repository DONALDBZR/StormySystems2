<?php
// User Controller class
class UserController extends User {
    // Register method
    public function register() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // If-statement to verify whether the username does not exist in the database
        if (empty($this->selectUserUsername($userJSON->username))) {
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
                // Inserting User in the database
                $this->insertUser();
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
                $this->PHPMailer->Username = "stormysystems@gmail.com";
                // Sender's password
                $this->PHPMailer->Password = "Aegis4869_050200";
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
                return json_encode($message);
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
                return json_encode($message);
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
            return json_encode($message);
        }
    }
    // Login method
    public function login() {
        // Retrieving the JSON from the client
        $userJSON = json_decode(file_get_contents('php://input'));
        // If-statement to verify whether the username exists
        if (!empty($this->selectUserUsername($userJSON->usernameOrMailAddress))) {
            // Storing data for further processing
            $this->setUsername($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserUsername']);
            // If-statement to verify whether the password entered by the username is the same as the password in the database
            if ($userJSON->password == $this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserPassword']) {
                // If-statement to verify the use has a profile picture
                if ($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserPassword']) {
                    // Storing the data retrieved from the database in the class variables
                    $this->setUsername($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                    $this->setMailAddress($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                    $this->setPassword($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserPassword']);
                    $this->setType($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserType']);
                    $this->setProfilePicture($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserProfilePicture']);
                    $this->setFirstName($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserFirstName']);
                    $this->setLastName($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserLastName']);
                    $this->setDateOfBirth($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserDateOfBirth']);
                    // Starting session
                    session_start();
                    // Assigning the Session variable to be the username of the user
                    $_SESSION['username'] = $this->getUsername();
                    // Checking the session
                    $this->checkLoginSession();
                } else {
                    // Storing the data retrieved from the database in the class variables
                    $this->setUsername($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                    $this->setMailAddress($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                    $this->setPassword($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserPassword']);
                    $this->setType($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserType']);
                    $this->setProfilePicture("null");
                    $this->setFirstName($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserFirstName']);
                    $this->setLastName($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserLastName']);
                    $this->setDateOfBirth($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserDateOfBirth']);
                    // Starting session
                    session_start();
                    // Assigning the Session variable to be the username of the user
                    $_SESSION['username'] = $this->getUsername();
                    // Checking the session
                    $this->checkLoginSession();
                }
            } else {
                // Setting the class variables
                $this->setMailAddress($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                $this->setUsername($this->selectUserUsername($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                // Message to be encoded and sent
                $message = array(
                    "success" => "failure",
                    "url" => $this->domain . "/StormySystems2/Login",
                    "message" => $this->Renderer->userLoginIncorrectPassword()
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Sending the JSON
                return json_encode($message);
            }
        } else {
            // If-statement to verify whether the mail address exists
            if (!empty($this->selectUserMailAddress($userJSON->usernameOrMailAddress))) {
                // Storing the data needed for further processing
                $this->setMailAddress($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                // If-statement to verify whether the password entered by the user correspond with the passwordin the database
                if ($userJSON->password == $this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserPassword']) {
                    // If-statement to verify whether the user has a profile picture
                    if ($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserProfilePicture'] != null) {
                        // Storing the data retrieved from the database in the class variables
                        $this->setUsername($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                        $this->setMailAddress($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                        $this->setPassword($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserPassword']);
                        $this->setType($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserType']);
                        $this->setProfilePicture($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserProfilePicture']);
                        $this->setFirstName($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserFirstName']);
                        $this->setLastName($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserLastName']);
                        $this->setDateOfBirth($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserDateOfBirth']);
                        // Starting session
                        session_start();
                        // Assigning the Session variable to be the username of the user
                        $_SESSION['username'] = $this->getUsername();
                        // Checking the session
                        $this->checkLoginSession();
                    } else {
                        // Storing the data retrieved from the database in the class variables
                        $this->setUsername($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                        $this->setMailAddress($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                        $this->setPassword($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserPassword']);
                        $this->setType($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserType']);
                        $this->setProfilePicture("null");
                        $this->setFirstName($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserFirstName']);
                        $this->setLastName($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserLastName']);
                        $this->setDateOfBirth($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserDateOfBirth']);
                        // Starting session
                        session_start();
                        // Assigning the Session variable to be the username of the user
                        $_SESSION['username'] = $this->getUsername();
                        // Checking the session
                        $this->checkLoginSession();
                    }
                } else {
                    // Setting the class variables
                    $this->setMailAddress($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserMailAddress']);
                    $this->setUsername($this->selectUserMailAddress($userJSON->usernameOrMailAddress)[0]['UserUsername']);
                    // Message to be encoded and sent
                    $message = array(
                        "success" => "failure",
                        "url" => $this->domain . "/StormySystems2/Login",
                        "message" => $this->Renderer->userLoginIncorrectPassword()
                    );
                    // Preparing the header for the JSON
                    header('Content-Type: application/json');
                    // Sending the JSON
                    return json_encode($message);
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
                return json_encode($message);
            }
        }
    }
    // Check Login Session method
    public function checkLoginSession() {
        // If-statement to verify whether the Session's variable is correct
        if ($_SESSION["username"] == $this->getUsername()) {
            // If-statement to verify the type of the user
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
                // Sending the JSON
                return json_encode($message);
            } else if ($this->getType() == 1) {
                // Message to be encoded and sent
                $message = array(
                    "success" => "",
                    "url" => $this->domain . "/StormySystems2/Public",
                    "message" => ""
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting the user towards the Public portal
                header('Location:' . $this->domain . '/StormySystems2/Public');
                // Sending the JSON
                echo json_encode($message);
            } else if ($this->getType() == 2) {
                // Message to be encoded and sent
                $message = array(
                    "success" => "",
                    "url" => $this->domain . "/StormySystems2/Admin",
                    "message" => ""
                );
                // Preparing the header for the JSON
                header('Content-Type: application/json');
                // Redirecting the user towards the Admin Portal
                header('Location:' . $this->domain . '/StormySystems2/Admin');
                // Sending the JSON
                return json_encode($message);
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
                return json_encode($message);
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
            return json_encode($message);
        }
    }
}
?>