<?php
// Starting Output Buffer
ob_start();
// Importing Register.html
require_once $_SERVER['DOCUMENT_ROOT'] . '/StormySystems2/Pages/Register.html';
// Storing the contents of the output buffer into a variable
$html = ob_get_contents();
// Printing the html page
echo $html;
// Deleting the contents of the output buffer.
ob_end_flush();
?>