<?php
require 'oop_myfunctions.php';
//if the user is not logged in redirect to sign in page
if (!isset($_SESSION["login"])) {
    header("location: sign_in.php");
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else { // $_GET['id'] is not set
        header("location: show_users.php");
    }


    if (isset($_POST['submit'])) {

        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];


        $adminUpdatePassword = new AdminUpdatePassword();
        $result = $adminUpdatePassword->update_password($id, $new_password, $confirm_password);
        //password less than 8 characters
        if ($result == 10) {
            echo "<div class='message'>
        <p>Password can't be less than 8 characters!</p>
        </div> <br>";
        }
        //passwords don't match return 100
        else {

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
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>update password</title>
</head>

<body>

    <?php include 'layouts/menu.php' ?>
    <div style="height: 23px;"></div>

    <div class="update-container">
        <div class="box form-box update-form-box">

            <header>Update password</header>
            <form action="" method="post">

                <div class="field input">
                    <label for="new_password">new password</label>
                    <input type="password" name="new_password" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="confirm_password">confirm password</label>
                    <input type="password" name="confirm_password" id="email" autocomplete="off" required>
                </div>

                <div class="field">

                    <input type="submit" class="update_btn" name="submit" value="Update" required>
                </div>

            </form>
        </div>

    </div>
    <div style="height: 23px;"></div>
    <?php include 'layouts/footer.php' ?>

</body>

</html>