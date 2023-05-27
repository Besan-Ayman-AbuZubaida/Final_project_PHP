<?php
require 'oop_myfunctions.php';
//if the user not logged in redirect to sign in page

if (!isset($_SESSION["login"])) {
    header("location: sign_in.php");
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header("location: show_users.php");
    }


    if (isset($_POST['submit'])) {
        $old_password = md5($_POST['old_password']);
        // not hashed yet to make sure they are less than 8 character, then the will be hashed
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];


        $update_password = new UpdatePassword();
        $result = $update_password->update_password($id, $old_password, $new_password, $confirm_password);
        //password less than 8 characters
        if ($result == 10) {
            echo "<div class='message'>
        <p>Password can't be less than 8 characters!</p>
        </div> <br>";
        }
        //passwords don't match
        else if ($result == 100) {
            echo "<div class='message'>
        <p>Passwords don't match!</p>
        </div> <br>";
        } else {
            // result 1000 current password is wrong
            echo "<div class='message'>
        <p>Current password  is wrong!</p>
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
                    <label for="old_password">current password</label>
                    <input type="password" name="old_password" id="username" autocomplete="off" required>
                </div>
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