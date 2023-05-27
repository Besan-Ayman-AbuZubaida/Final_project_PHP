<?php
// contains session_start();
require 'oop_myfunctions.php';

//if the user is not logged in redirect to sign in page
if (!isset($_SESSION["login"])) {
    header("location: sign_in.php");
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $deleteUserObj = new DeleteUser();
        $deleteUserObj->deleteUser($id);
    } else {
        header("location: show_users.php");
    }
}
?>