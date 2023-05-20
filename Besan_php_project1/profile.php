
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/style2.css"> -->
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  
  <style>
    .button {
      display: inline-block;
      padding: 10px 20px;
      /* background: rgba(76,68,182,0.808); */
      background-color: #4caf50;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      border: none;
      cursor: pointer;
      /* margin-top: 10px; */
    }
    body{
        background-color:#e4e9f7;
        
    }
    .profile_main{
        padding: 20px;
    }
  </style>
</head>

<body>
    <header>
    <?php include 'layouts/menu.php'?>
    </header>
  
           
    
<div class="profile_main" >   
      
            <br>
                <p>Hello <b><?php //echo $res_Uname ?></b>, Welcome</p>
                <br>
           
             
                <p>Your email is <b><?php // echo $res_Email ?></b>.</p>
           
                <br> 
                <p>And your role is  <b><?php //echo $ ?> </b>.</p> 
                <br>
                <p>profile created at  <b><?php //echo $ ?> </b>.</p> 
                <br>
                <a href="#" class="button">Change Password</a>
                <br> <br> <br><br> 
</div>
        <?php include 'layouts/footer.php'?>
    
</body>
</html>