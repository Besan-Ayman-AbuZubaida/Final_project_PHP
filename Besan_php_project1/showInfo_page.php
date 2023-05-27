<?php
require 'oop_myfunctions.php';
//if the user is not logged in redirect to sign in page
if (!isset($_SESSION["login"])) {
  header("location: sign_in.php");
} else {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = new Select();
    $res = $select->selectUserById($id);
    if ($res && $res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $username = $row['username'];
      $email = $row['email'];
      $role = $row['role'];
      $created_at = $row['created_at'];
    } else {  //id invalid zero record returned from db
      // (id not valid may be user enterd it manulaay in the url)
      header("location: show_users.php");
    }
  } else { //$_GET['id'] is not set 
    header("location: show_users.php");
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>show</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">

  <style>
    body {
      background: #e4e9f7;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;

    }

    .show-info {

      margin-bottom: 20px;
    }

    .show-info h3 {
      margin-bottom: 10px;
      font-weight: bold;
      /* color: #b45f06; */
      color: #814404;
    }

    .show-info p {
      margin-bottom: 5px;
    }
  </style>
</head>

<body>
  <?php include 'layouts/menu.php' ?>
  <div class="container">
    <div class="show-info">
      <h3 style="margin-top: 30px;">Name:</h3>
      <p><?php echo $username ?></p>
    </div>
    <div class="show-info">
      <h3>Email:</h3>
      <p><?php echo $email ?></p>
    </div>
    <div class="show-info">
      <h3>Role:</h3>
      <p><?php echo $role == 1 ? 'admin' : 'user' ?></p>
    </div>
    <div class="show-info">
      <h3>Created at:</h3>
      <p><?php echo $created_at ?></p>
    </div>
  </div>
  <?php include 'layouts/footer.php' ?>
</body>

</html>