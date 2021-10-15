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
        <link rel="stylesheet" href="../Stylesheets/Register.css" />
        <link rel="shortcut icon" href="../Images/Logo.ico" type="image/x-icon" />
        <script src="../Scripts/Font-Awesome.js"></script>
        <script crossorigin src="https://unpkg.com/react@17/umd/react.production.min.js"></script>
        <script crossorigin src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js" integrity="sha512-kp7YHLxuJDJcOzStgd6vtpxr4ZU9kjn77e6dBsivSz+pUuAuMlE2UTdKB7jjsWT84qbS8kdCWHPETnP/ctrFsA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="../Scripts/Register.js"></script>
    </head>
    <body id="app">
        <!-- <script type="text/babel" src="../Scripts/Register.js"></script> -->
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
            <form method="post" onsubmit="register()">
                <div id="label">Registration Form</div>
                <div id="formContainer">
                    <div id="username">
                        <div id="input">
                            <div>Username *:</div>
                            <input type="text" name="username" id="username" placeholder="Username" required />
                        </div>
                        <div id="guidelines">
                            Please enter a username which is unique!
                        </div>
                        <div id="guidelines">
                            Ensure that your username is not NSFW!
                        </div>
                    </div>
                    <div id="mailAddress">
                        <div id="input">
                            <div>Mail Address *:</div>
                            <input type="email" name="mailAddress" id="mailAddress" placeholder="Mail Address" required />
                        </div>
                        <div id="guidelines">
                            The Mail Address is required to send you your
                            password and to access your account, afterwards.
                        </div>
                    </div>
                    <div id="firstName">
                        <div id="input">
                            <div>First Name *:</div>
                            <input type="text" name="firstName" id="firstName" placeholder="First Name" required />
                        </div>
                        <div id="guidelines">
                            Please enter your first name!
                        </div>
                    </div>
                    <div id="lastName">
                        <div id="input">
                            <div>Last Name *:</div>
                            <input type="text" name="lastName" id="lastName" placeholder="Last Name" required />
                        </div>
                        <div id="guidelines">
                            Please enter your last name!
                        </div>
                    </div>
                    <div id="dateOfBirth">
                        <div id="input">
                            <div>Date Of Birth *:</div>
                            <input type="date" name="dateOfBirth" id="dateOfBirth" required />
                        </div>
                        <div id="guidelines">
                            Please enter your date of birth!
                        </div>
                        <div id="guidelines">
                            You need to be at least thirteen years old to
                            register into this system!
                        </div>
                    </div>
                    <div id="registrationButton">
                        <input type="submit" value="Register" />
                    </div>
                </div>
                <div id="serverRendering">
                    <?php
                    // If-statement to verify whether the registration button is pressed
                    if (isset($_POST["username"])) {
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