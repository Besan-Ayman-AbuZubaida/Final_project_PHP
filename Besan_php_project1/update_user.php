
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Change Profile</title>
</head>

<body>
    
<?php  include 'layouts/menu.php'?>
<div style="height: 23px;"></div>

    <div class="update-container">
        <div class="box form-box update-form-box">
            
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php //echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php //echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="update_btn"  name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
       
      </div>
      <div style="height: 23px;"></div>
      <?php include 'layouts/footer.php'?>

</body>
</html>