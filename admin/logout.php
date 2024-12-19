<?php
// Load all the required classes in /lib directory
spl_autoload_register(function($class) {
    include __DIR__ . "/../lib/" . $class . '.php';
});
session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$db = new DB();
$ad = new AD();
// Just logout the user and redirect to login page
session_destroy();
header("location: login.php");
exit;

