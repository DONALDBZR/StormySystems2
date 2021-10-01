<?php
// Importing User.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
// Instantiation User
$User = new User();
// Starting Output Buffer
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Andy Ewen Gaspard" />
        <title>Stormy Systems</title>
        <link rel="stylesheet" href="../Stylesheets/Login.css" />
        <link rel="shortcut icon" href="../Images/Logo.ico" type="image/x-icon" />
        <script src="../Scripts/Font-Awesome.js"></script>
    </head>
    <body id="app">
        <header>
            <nav>
                <div>
                    <a href="../">
                        <img src="../Images/Logo.png" alt="System Logo" />
                    </a>
                </div>
                <div>
                    <a href="../AboutUs">About Us</a>
                </div>
                <div>
                    <a href="../Service">Services Offered</a>
                </div>
                <div>
                    <a href="../Projects">Projects</a>
                </div>
                <div>
                    <a href="./">Login</a>
                </div>
                <div>
                    <a href="../Register">Register</a>
                </div>
            </nav>
        </header>
        <main>
            <div id="formContainer">
                <form method="post">
                    <div id="label">Login Form</div>
                    <div id="formContainerInsideAForm">
                        <div id="usernameOrMailAddress">
                            <div id="input">
                                <div>Username / Mail Address:</div>
                                <input type="text" name="usernameOrMailAddress" id="usernameOrMailAddress"  placeholder="Username or Mail Address" required />
                            </div>
                            <div id="guidelines">Please enter your username or the mail address that you have used to register!</div>
                        </div>
                        <div id="password">
                            <div id="input">
                                <div>Password:</div>
                                <input type="password" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div id="guidelines">Please enter your password!</div>
                            <div id="guidelines">If, you have just registered into the system, your password has been sent to you by mail but please consider to change it!</div>
                        </div>
                        <div id="loginButton">
                            <input type="submit" value="Login" name="login" />
                        </div>
                    </div>
                </form>
                <div id="serverRendering">
                    <?php
                    // If-statement to verify whether the registration button is pressed
                    if (isset($_POST["login"])) {
                        $User->login();
                    }
                    ?>
                </div>
            </div>
        </main>
        <footer>
            <h1>Stormy Systems</h1>
        </footer>
    </body>
</html>
<?php
// Storing the contents of the output buffer into a variable
$html = ob_get_contents();
// Deleting the contents of the output buffer.
ob_end_clean();
// Printing the html page
echo $html;
?>