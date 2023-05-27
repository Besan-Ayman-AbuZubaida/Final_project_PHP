<?php
require 'oop_myfunctions.php';
//if the user is not logged in redirect to sign in page
if (!isset($_SESSION["login"])) {
    header("location: sign_in.php");
}
?>


<html>

<head>
    <title>Manage users - Home Page</title>

    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<!-- Header section Starts-->
<?php include 'layouts/menu.php' ?>
<!-- Header section Ends-->


<body>
    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Users</h1>
            <br />

            <?php
            // This when I want tp print a message like user updated/password changed
            if (isset($_SESSION['user'])) {
                echo $_SESSION['user'];
                //then unset it to just print it once
                unset($_SESSION['user']);
            }
            // $select = new Select();

            //if admin display table of all users
            if ($_SESSION['role'] == 1) {
                $selectAll = new SelectAll();
                $res = $selectAll->selectAllForAdmin();
                echo '<table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>';
                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $id = $row['id'];
                        $username = $row['username'];
            ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="showInfo_page.php?id=<?php echo $id ?>" class="btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="update_admin.php?id=<?php echo $id ?>" class="btn-secondary"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="#" class="btn-danger" onclick="confirmDelete();"><i class="fas fa-trash"></i></a>&nbsp;
                                <a href="admin_update_password.php?id=<?php echo $id ?>" class="profile_button">change password</a>&nbsp;

                                <script>
                                    // to let the admin confirm if he is sure to delete a user
                                    function confirmDelete() {
                                        var userResponse = confirm("Are you sure you want to delete?");
                                        if (userResponse) {
                                            window.location.href = "delete_user.php?id=<?php echo $id ?>";
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                <?php  }
                }
                // else{
                //   echo '<tr>
                //             <td>
                //                 <p> no admins or users yet ! </p></td>
                //             </tr>';
                // }
                ?>
                </table>

                <!-- if user not admin -->
                <?php } else {
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                    $select = new Select();
                    //get only the data of this specific user
                    $res = $select->selectUserById($id);
                    if ($res && $res->num_rows > 0) {
                        echo '<table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>';
                        $row = $res->fetch_assoc();
                        $id = $row['id'];
                        $username = $row['username'];
                ?>
                        <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="showInfo_page.php?id=<?php echo $id ?>" class="btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="update_user.php?id=<?php echo $id ?>" class="btn-secondary"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                                <a href="#" onclick="confirmDelete();" class="btn-danger"><i class="fas fa-trash"></i></a>&nbsp;
                                <a href="change_password.php?id=<?php echo $id ?>" class="profile_button">change password</a>&nbsp;
                                <!-- user confirm he wants to delete his/her account -->
                                <script>
                                    function confirmDelete() {
                                        var userResponse = confirm("Are you sure you want to delete?");
                                        if (userResponse) {
                                            window.location.href = "delete_user.php?id=<?php echo $id ?>";
                                        }
                                    }
                                </script>
                            </td>
                        </tr>
                        </table>
            <?php   }
                }
            }
            ?>

        </div>
    </div>
    <!-- Main Content Setion Ends -->

    <!-- Footer Section Starts -->
    <?php include 'layouts/footer.php' ?>
    <!-- Footer Section Ends -->

</body>

</html>