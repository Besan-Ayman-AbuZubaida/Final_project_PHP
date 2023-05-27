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
            $old_email = $row['email']; // old email is stored bcoz it is needed when the 
            //user updates his email new email must be unique not dupliacted
            $role = $row['role'];
        } else {
            //nothing returned from db (id not valid may be user enterd it manulaay in the url)
            header("location: show_users.php");
        }
    } else { // is not set
        header("location: show_users.php");
    }


    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $updateForAdmin = new UpdateForAdmin();
        $res = $updateForAdmin->updateForAdmin($id, $username, $email, $role, $old_email);
        //if email is already used so can't be duplicated choose another email
        if ($res == 10) {
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
    <div class="update-container">
        <div class="box form-box update-form-box">

            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username) ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($old_email); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="1" <?php if ($role == 1) echo 'selected' ?>>admin</option>
                        <option value="2" <?php if ($role == 2) echo 'selected' ?>>user</option>
                    </select>

                </div>

                <div class="field">

                    <input type="submit" class="update_btn" name="submit" value="Update" required>
                </div>

            </form>
        </div>

    </div>
    <?php include 'layouts/footer.php' ?>

</body>

</html>