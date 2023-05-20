<html>
<head>
    <title>Manage users - Home Page</title>

    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>

<!-- Header -->
<?php include 'layouts/menu.php'?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Users</h1>

        <br/>

        <br><br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <tr>
                <td>id</td>
                <td>username</td>
                <td>
                    <a href="#" class="btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="update-admin.php?id=id" class="btn-secondary"><i class="fas fa-pencil-alt"></i></a>&nbsp;
                    <a href="delete-admin.php?id=id" class="btn-danger"><i class="fas fa-trash"></i></a>&nbsp;
                </td>
            </tr>

            <tr>
                <td>
                    <p> no users yet ! </p></td>
            </tr>

        </table>

    </div>
</div>
<!-- Main Content Setion Ends -->

<!-- Footer Section Starts -->
<?php include 'layouts/footer.php'?>
<!-- Footer Section Ends -->

</body>
</html>