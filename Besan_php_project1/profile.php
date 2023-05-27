<?php
//start the session/connect to db/ access proper functions for essential operations
require 'oop_myfunctions.php';
//if the user is not logged in redirect to sign in page
if (!isset($_SESSION["login"])) {
  header("location: sign_in.php");
} else {
  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $select = new Select();
    $res = $select->selectUserById($id);
    if ($res && $res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $username = $row['username'];
      $email = $row['email'];
      $role = $row['role'];
      $created_at = $row['created_at'];
      $old_hash_password = $row['password'];
    }
    // when num of rows returned from database is 0 ((no users with this id))
    else {
      header("location: show_users.php");
    }
  }
  //session[id]not set
  else {
    header("location: show_users.php");
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/style2.css"> -->
  <title>Profile</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/profile.css">

</head>

<body class="profile_body">
  <header>
    <?php include 'layouts/menu.php' ?>
  </header>



  <div class="profile_main">

    <br>
    <p>Hello <b><?php echo $username ?></b></p>
    <br>

    <p>Your email is <b><?php echo $email ?></b>.</p>

    <br>
    <p>And your role is <b><?php echo ($role == 1) ? "admin" : "user" ?> </b>.</p>
    <br>
    <p>profile created at <b><?php echo $created_at ?> </b>.</p>
    <br>
    <a href="change_password.php?id=<?php echo $id ?>" class="profile_button">Change Password</a>
    <br> <br> <br><br>
  </div>
  <?php include 'layouts/footer.php' ?>

</body>

</html>