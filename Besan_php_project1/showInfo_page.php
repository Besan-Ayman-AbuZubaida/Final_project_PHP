<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  
  <style>
    body{
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
    <?php include 'layouts/menu.php'?>
  <div class="container">
    <div class="show-info">
      <h3 style="margin-top: 30px;">Name:</h3>
      <p>Besan Ayman</p>
    </div>
    <div class="show-info">
      <h3>Email:</h3>
      <p>besan@gmail.com</p>
    </div>
    <div class="show-info">
      <h3>Role:</h3>
      <p>admin</p>
    </div>
    <div class="show-info">
      <h3>Created at:</h3>
      <p>5/5/2023</p>
    </div>
  </div>
  <?php include 'layouts/footer.php'?>
</body>
</html>
