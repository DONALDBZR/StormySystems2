<?php
// Importing User.php
require $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/StormySystem.php';
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
        <link rel="stylesheet" href="../Stylesheets/Register.css" />
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
                    <a href="../Login">Login</a>
                </div>
                <div>
                    <a href="./">Register</a>
                </div>
            </nav>
        </header>
        <main>
            <form method="post">
                <div id="label">Registration Form</div>
                <div id="formContainer">
                    <div id="username">
                        <div id="input">
                            <div>Username *:</div>
                            <input type="text" name="username" id="username"  placeholder="Username" required />
                        </div>
                        <div id="guidelines">Please enter a username which is unique!</div>
                        <div id="guidelines">Ensure that your username is not NSFW!</div>
                    </div>
                    <div id="firstName">
                        <div id="input">
                            <div>First Name *:</div>
                            <input type="text" name="firstName" id="firstName"  placeholder="First Name" required />
                        </div>
                        <div id="guidelines">Please enter your first name!</div>
                    </div>
                    <div id="lastName">
                        <div id="input">
                            <div>Last Name *:</div>
                            <input type="text" name="lastName" id="lastName"  placeholder="Last Name" required />
                        </div>
                        <div id="guidelines">Please enter your last name!</div>
                    </div>
                    <div id="dateOfBirth">
                        <div id="input">
                            <div>Date Of Birth *:</div>
                            <input type="date" name="dateOfBirth" id="dateOfBirth" required />
                        </div>
                        <div id="guidelines">Please enter your date of birth!</div>
                        <div id="guidelines">You need to be at least thirteen years old to register into this system!</div>
                    </div>
                    <div id="registrationButton">
                        <input type="submit" value="Register" name="register" />
                    </div>
                </div>
                <div id="serverRendering">
                    <?php
                    // If-statement to verify whether the registration button is pressed
                    if (isset($_POST["register"])) {
                        $User->register();
                    }
                    ?>
                </div>
            </form>
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