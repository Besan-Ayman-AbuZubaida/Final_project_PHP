<?php
require 'oop_myfunctions.php';
//if the user is not logged in redirect to sign in page

if (!isset($_SESSION["login"])) {
    header("location: sign_in.php");
} else { // user has a session
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = new Select();
        $res = $select->selectUserById($id);
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $username = $row['username'];
            $old_email = $row['email'];
        } else { //if 0 rows returns from db redirect to the previous page
            header("location: show_users.php");
        }
    } else { // if id is not set redirect to the previous page
        header("location: show_users.php");
    }


    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];


        $updateForUser = new UpdateForUser();
        $res = $updateForUser->updateForUser($id, $username, $email, $old_email);
        if ($res == 10) {
            // can't update email to the email of another user email must be unique
            echo "<div class='message'>
            <p>email is already used, plesae choose another one</p>
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
    <title>update</title>
</head>

<body>

    <?php include 'layouts/menu.php' ?>
    <div style="height: 23px;"></div>

    <div class="update-container">
        <div class="box form-box update-form-box">

            <header>Update user</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($old_email); ?>" autocomplete="off" required>
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