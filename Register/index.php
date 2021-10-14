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
        <script
            crossorigin
            src="https://unpkg.com/react@17/umd/react.production.min.js"
        ></script>
        <script
            crossorigin
            src="https://unpkg.com/react-dom@17/umd/react-dom.production.min.js"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"
            integrity="sha512-kp7YHLxuJDJcOzStgd6vtpxr4ZU9kjn77e6dBsivSz+pUuAuMlE2UTdKB7jjsWT84qbS8kdCWHPETnP/ctrFsA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>
        <script src="../Scripts/StormySystems.js"></script>
    </head>
    <body id="app">
        <script type="text/babel" src="../Scripts/Register.js"></script>
        <?php
        // If-statement to verify whether the registration button is pressed
        if (isset($_POST["register"])) {
            $User->register();
        }
        ?>
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