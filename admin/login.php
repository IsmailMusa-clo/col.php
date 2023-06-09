<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['submit'])) {
   $username = get_safe_value($con, $_POST['username']);
   $password = get_safe_value($con, $_POST['password']);
   $sql = "select * from admin_users where username='$username' and password='$password'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count > 0) {
      $row = mysqli_fetch_assoc($res);
      if ($row['status'] == '0') {
         $msg = "Account deactivated";
      } else {
         $_SESSION['ADMIN_LOGIN'] = 'yes';
         $_SESSION['ADMIN_ID'] = $row['id'];
         $_SESSION['ADMIN_USERNAME'] = $username;
         $_SESSION['ADMIN_ROLE'] = $row['role'];
         header('location:index.php');
         die();
      }
   } else {
      $msg = "PLEASE ENTER CORRECT LOGIN DETAILS";
   }
}
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
   <meta name="author" content="Lukasz Holeczek">
   <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
   <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
   <title>CoreUI Bootstrap 4 Admin Template</title>
   <!-- Icons -->
   <link href="assets/css/font-awesome.css" rel="stylesheet">
   <link href="assets/css/simple-line-icons.css" rel="stylesheet">
   <!-- Main styles for this application -->
   <link href="assets/css/dest/style.css" rel="stylesheet">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
            <div class="card-group ">
               <div class="card p-a-2">
                  <div class="card-block">
                     <h1>تسجيل الدخول للمدير</h1>
                     <p class="text-muted"> </p>
                     <form method="post" action="">
                        <div class="input-group m-b-1">
                           <span class="input-group-addon"><i class="icon-user"></i>
                           </span>
                           <input type="text" class="form-control en" name="username" placeholder="اسم المستخدم">
                        </div>
                        <div class="input-group m-b-2">
                           <span class="input-group-addon"><i class="icon-lock"></i>
                           </span>
                           <input type="password" class="form-control en" name="password" placeholder="كلمة المرور ">
                        </div>
                        <div class="row">
                           <div class="col-xs-6">
                              <button type="submit" name="submit" class="btn btn-primary p-x-2">
                                 <i class="icon-login"></i> تسجيل الدخول</button>
                           </div>
                        </div>
                     </form>
                     <div class="field_error"><?php echo $msg ?></div>
                  </div>
               </div>
               <div class="card card-inverse card-primary p-y-3" style="width:44%">
                  <div class="card-block text-xs-center">
                     <div>
                        <h2>أهلا وسهل بكم كلية جازان التقنية للبنين</h2>
                        <a href="../index.php" class="btn btn-primary active m-t-1">العودة للصفحة الرئيسية </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Bootstrap and necessary plugins -->
   <script src="assets/js/libs/jquery.min.js"></script>
   <script src="assets/js/libs/tether.min.js"></script>
   <script src="assets/js/libs/bootstrap.min.js"></script>
   <script>
      function verticalAlignMiddle() {
         var bodyHeight = $(window).height();
         var formHeight = $('.vamiddle').height();
         var marginTop = (bodyHeight / 2) - (formHeight / 2);
         if (marginTop > 0) {
            $('.vamiddle').css('margin-top', marginTop);
         }
      }
      $(document).ready(function() {
         verticalAlignMiddle();
      });
      $(window).bind('resize', verticalAlignMiddle);
   </script>
   <!-- Grunt watch plugin -->
   <script src="//localhost:35729/livereload.js"></script>
</body>

</html>