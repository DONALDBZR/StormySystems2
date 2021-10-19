<?php
// Importing Register.html
require_once $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/Pages/Register.html';
// Starting Output Buffer
ob_start();
// Storing the contents of the output buffer into a variable
$html = ob_get_contents();
// Deleting the contents of the output buffer.
ob_end_flush();
// Printing the html page
echo $html;
?>