 <!-- This is the oo classes    -->
 <!-- it starts the session/connect to the database / have primary oo functions -->
 <?php

  session_start();

  class Connection
  {
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "php_project_1";
    public $conn;

    public function __construct()
    {
      $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
      if ($this->conn->connect_error) {
        die("Connecton Failed: " . $this->conn->connect_error);
      }
    }
  }

  //for sign up
  class Register extends Connection
  {
    public $id, $role;
    public function registration($username, $email, $password, $confirmpassword)
    {
      //sql injection safe
      $duplicate = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $duplicate->bind_param("s", $email);
      $duplicate->execute();
      if ($duplicate->error) {
        die("Error executing statement: " . $duplicate->error);
      }
      $res = $duplicate->get_result();

      if ($res->num_rows > 0) {
        return 10;
        //  email has already used
      } else {
        if ($password == $confirmpassword) {
          $q = $this->conn->prepare("INSERT INTO users(username, email, password, role) VALUES(?,?,?,?)");
          $role = 2;
          $q->bind_param("sssi", $username, $email, $password, $role);
          $q->execute();
          if ($q->error) {
            die("Error executing statement: " . $q->error);
          } else {
            $this->id = $this->conn->insert_id;

            return 1;
            // Registration successful
          }
        } else {
          return 100;

          // Passwords does not match
        }
      }
    }
    public function idUser()
    {
      return $this->id;
    }
  }

  class Login extends Connection
  {
    public $id, $role;
    public function login($email, $password)
    {
      $result = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
      $result->bind_param("s", $email);
      $result->execute();
      if ($result->error) {
        die("Error executing statement: " . $result->error);
      }
      $res = $result->get_result();

      if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();

        if ($password == $row["password"]) {
          $this->id = $row["id"];
          $this->role = $row['role'];
          return 1;
          // Login successful
        } else {
          return 10;
          // Wrong password
        }
      } else {
        return 100;
        // User not registered
      }
    }

    public function idUser()
    {
      return $this->id;
    }
    public function getRole()
    {
      return $this->role;
    }
  }

  class SelectAll extends Connection
  {
    public function selectAllForAdmin()
    {
      $sql = "SELECT * FROM users";
      $res = $this->conn->query($sql);
      return $res;
    }
  }
  class Select extends Connection
  {
    public function selectUserById($id)
    {
      $sql = $this->conn->prepare("SELECT * FROM users where id=?");
      $sql->bind_param("s", $id);
      $sql->execute();
      if ($sql->error) {
        die("Error executing statement: " . $sql->error);
      }
      $res = $sql->get_result();

      return $res;
    }
  }
  class ValidateEmail extends Connection
  {
    // to not have duplicate email when user/ admin update data
    public function validateEmail($old_email, $email)
    {
      if ($old_email != $email) {
        $duplicate = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $duplicate->bind_param("s", $email);
        $duplicate->execute();
        if ($duplicate->error) {
          die("Error executing statement: " . $duplicate->error);
        }
        $res = $duplicate->get_result();

        if ($res->num_rows > 0) {
          //  email has already used
          return 10;
        } else {
          return 1;
        }
      }
    }
  }

  class UpdateForAdmin extends Connection
  {


    public function updateForAdmin($id, $username, $email, $role, $old_email)
    {
      $validate = new ValidateEmail();
      $res = $validate->validateEmail($old_email, $email);

      if ($res == 10) {
        return 10;
      } else {
        $q = $this->conn->prepare("UPDATE users  set username=?, email=?, role =? where id='$id'");
        $q->bind_param("ssi", $username, $email, $role);
        $q->execute();
        if ($q->error) {
          $_SESSION['user'] = '<div class=error>user is not updated</div>';
          header("location: show_users.php");
          die("Error executing statement: " . $q->error);
        } else {

          $_SESSION['user'] = '<div class=success>user is updated</div>';
          header("location: show_users.php");
        }
      }
    }
  }


  class UpdateForUser extends Connection
  {
    public function updateForUser($id, $username, $email, $old_email)
    {
      $validate = new ValidateEmail();
      $res = $validate->validateEmail($old_email, $email);

      if ($res == 10) {
        return 10;
      } else {
        $q = $this->conn->prepare("UPDATE users  set username=?, email=? where id='$id'");
        $q->bind_param("ss", $username, $email);
        $q->execute();
        if ($q->error) {
          $_SESSION['user'] = '<div class=error>user is not updated</div>';
          header("location: show_users.php");
          die("Error executing statement: " . $q->error);
        } else {

          $_SESSION['user'] = '<div class=success>user is updated</div>';
          header("location: show_users.php");
        }
      }
    }
  }
  class UpdatePassword extends Connection
  {
    public function update_password($id, $old_password, $new_password, $confirm_password)
    {

      $res = $this->conn->prepare("SELECT password FROM users WHERE id = ?");
      $res->bind_param("s", $id);
      $res->execute();
      if ($res->error) {
        die("Error executing statement: " . $res->error);
      } else {
        $result = $res->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $old_pass_from_db = $row['password'];
        }
        if ($old_password == $old_pass_from_db) {
          if ($new_password == $confirm_password) {
            if (strlen($new_password) < 8) {
              //password can't be less than 8 characters
              return 10;
            } else {
              $query = $this->conn->prepare("UPDATE users  set password=? where id=?");
              $query->bind_param("ss", md5($new_password), $id);
              $query->execute();
              if ($query->error) {
                $_SESSION['user'] = '<div class=error>password is not changed</div>';
                header("location: show_users.php");
                die("Error executing statement: " . $query->error);
              } else {

                $_SESSION['user'] = '<div class=success>password is changed</div>';
                header("location: show_users.php");
              }
            }
          } else {
            //passwords don't match
            return 100;
          }
        } else {
          //current password is not correct
          return 1000;
        }
      }
    }
  }
  class DeleteUser extends Connection
  {
    public function deleteUser($id)
    {
      $res = $this->conn->prepare("DELETE FROM users WHERE id = ?");
      $res->bind_param("s", $id);
      $res->execute();
      if ($res->error) {
        $_SESSION['user'] = '<div class=error>user is not deleted</div>';
        header("location: show_users.php");
        die("Error executing statement: " . $res->error);
      } else {
        $_SESSION['user'] = '<div class=success>user is deleted</div>';
        header("location: show_users.php");
      }
    }
  }

  class AdminUpdatePassword extends Connection
  {
    public function update_password($id, $new_password, $confirm_password)
    {


      if ($new_password == $confirm_password) {
        if (strlen($new_password) < 8) {
          //password can't be less than 8 characters
          return 10;
        } else {
          $query = $this->conn->prepare("UPDATE users  set password=? where id=?");
          $query->bind_param("ss", md5($new_password), $id);
          $query->execute();
          if ($query->error) {
            $_SESSION['user'] = '<div class=error>password is not changed</div>';
            header("location: show_users.php");
            die("Error executing statement: " . $query->error);
          } else {

            $_SESSION['user'] = '<div class=success>password is changed</div>';
            header("location: show_users.php");
          }
        }
      } else {
        //passwords don't match
        return 100;
      }
    }
  }
