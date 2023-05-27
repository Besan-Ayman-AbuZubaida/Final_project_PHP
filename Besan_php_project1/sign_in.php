<?php
require 'oop_myfunctions.php';
$email = '';

$login = new Login();

if (isset($_POST["submit"])) {

  $result = $login->login($_POST["email"], md5($_POST["password"]));

  // when log in successfully
  if ($result == 1) {
    // use it to make sure that the user has a session so with login being not set the 
    //user not allowed to access any page

    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();

    //get the role to later display appropriate pages/actions bcoz of different permissions
    $_SESSION["role"] = $login->getRole();
    header("Location: show_users.php");
    // when the user navigate back using back button on the browser
    header('Cache-Control: no cache');
    session_cache_limiter('private_no_expire');

    // when user entered email is true and password wrong
  } else if ($result == 10) {
    // to assign $email variable to value attribute in input html tag to be displayed and user hasn't 
    //had to reenter the email when password is only wrong and email valid

    $email = $_POST["email"];
    echo "<div class='message'>
        <p>Wrong Password</p>
        </div> <br>";
  } else if ($result == 100) {  //email wrong - not found/registered
    echo "<div class='message'>
    <p>User Not Registered</p>
    </div> <br>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="box form-box">

      <header>Login</header>
      <form action="" method="post">
        <div class="field input">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" autocomplete="off" required value=<?php echo htmlspecialchars($email); ?>>
        </div>

        <div class="field input">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" autocomplete="off" required>
        </div>

        <div class="field">

          <input type="submit" class="btn" name="submit" value="Login" required>
        </div>
        <div class="links">
          Don't have account? <a href="sign_up.php">Sign Up Now</a>
        </div>
      </form>
    </div>

  </div>
</body>

</html>