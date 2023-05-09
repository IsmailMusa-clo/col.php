<?php
session_start();
require('admin/connection.inc.php');
require('admin/functions.inc.php');
$msg = '';
if (isset($_POST['submit'])) {
   $username =  $_POST['username'];
   $password = $_POST['password'];
   $sql = "select * from students where name='$username' and password='$password'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count > 0) {
      $row = mysqli_fetch_assoc($res);
         var_dump($row['id']);
         $_SESSION['STD_LOGIN'] = 'yes';
         $_SESSION['STD_ID'] = $row['id'];
         $_SESSION['STD_USERNAME'] = $username;
         $_SESSION['STD_ROLE'] = $row['role'];
         header('location:student_dash.php');
         die();
   } else {
      $msg = "PLEASE ENTER CORRECT LOGIN DETAILS";
   }
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>LOGIN PAGE</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <!-- <link rel="stylesheet" href="css/style.css">  -->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<style>
   body {
      background-image: url('images/background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
   }

   .login-content {
      background-color: aliceblue;
      padding: 40px;
      width: 60%;
      margin: auto;
      margin-top: 20%;
   }
</style>

<body class="bg-dark">
   <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="container ml-5">
         <div class="login-content ">
            <div class="login-form mt-150">
               <form method="post">
                  <div class="form-group">
                     <label><b>USERNAME</b></label>
                     <input type="text" name="username" class="form-control" placeholder="        " required>
                  </div>
                  <div class="form-group">
                     <label><b>PASSWORD</b></label>
                     <input type="password" name="password" class="form-control" placeholder="          " required>
                  </div>
                  <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">SIGN IN</button>
               </form>
               <div class="field_error"><?php echo $msg ?></div>
            </div>
         </div>
      </div>
   </div>
   <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
   <script src="assets/js/popper.min.js" type="text/javascript"></script>
   <script src="assets/js/plugins.js" type="text/javascript"></script>
   <script src="assets/js/main.js" type="text/javascript"></script>
</body>

</html>