<?php
require 'oop_myfunctions.php';
$errors = [];
$username = '';
$email = '';

$register = new Register();

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is not valid, Try another One Please!';
    } else {
        // can be printed in input field when there is  an error with passwords so user 
        //don't have to rewrite it
        $email = $_POST['email'];
    }


    if (strlen($_POST['password']) < 8) {
        $errors[] = "Password can't be less than 8 characters!";
    } else {
    }
    if (count($errors) > 0) {

        echo "<div class='message'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo  "</div> <br>";
    } else { //count($errors)== 0


        $password = md5($_POST['password']);
        $confirm_password = md5($_POST['confirm_password']);
        $result = $register->registration($username, $email, $password, $confirm_password);
        if ($result == 1) {
            // registration successfull
            $_SESSION["login"] = true;
            $_SESSION["id"] = $register->idUser();

            header("location:sign_in.php");
            //when the user navigate back using back button on the browser
            header('Cache-Control: no cache');
            session_cache_limiter('private_no_expire');


            // already has an acount please sign in 
        } elseif ($result == 10) {
            echo "<div class='message'>
                                <p>This email is used, Try another One Please!</p>
                            </div> <br>";

            //passwords don't match                    
        } elseif ($result == 100) {
            echo "<div class='message'>
                  <p>Passwords don't match!</p>
                  </div> <br>";
        }
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
    <title>Register</title>
</head>

<body>
    <br>
    <div class="container">
        <div class="box form-box">



            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required value=<?php echo htmlspecialchars($username); ?>>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required value=<?php echo htmlspecialchars($email); ?>>
                </div>


                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="confirm password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                </div>

                <div class="field">

                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already a member? <a href="sign_in.php">Sign In</a>
                </div>
            </form>
        </div>

    </div>
</body>

</html>