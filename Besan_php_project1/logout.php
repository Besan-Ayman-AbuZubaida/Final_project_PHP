<?php
   // session_start();
   require 'oop_myfunctions.php';
   session_destroy();
   header("Location: sign_in.php");
?>