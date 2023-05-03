<?php
include_once('connection.inc.php');
include_once('functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
   header('location:login.php');
   die();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="css/style.css">
    <title>لوحة تحكم عربية</title>
</head>

<body>

    <div class="">

        <!-- sidebar -->
        <div class="sidebar">
            <ul class="nav-list">
                <li class="nav-item brand-name">
                    <a href="index.php">
                        <span class="icon">
                            <i class='bx bx-md bxs-castle'></i>
                        </span>
                        <span class="title">لوحة التحكم</span>
                    </a>

                </li>
                <li class="nav-item active">
                    <a href="subjects.php">
                        <span class="icon">
                            <i class='bx bx-collapse-horizontal'></i>
                        </span>
                        <span class="title"> المساقات الدراسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="students.php">
                        <span class="icon">
                            <i class='bx bx-collapse-horizontal'></i> </span>
                        <span class="title">الطلبة</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="teachers.php">
                        <span class="icon">
                            <i class='bx bx-collapse-horizontal'></i> </span>
                        <span class="title">المدرسين</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact_us.php">
                        <span class="icon">
                            <i class='bx bx-collapse-horizontal'></i> </span>
                        <span class="title">طلبات التواصل</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main content -->
        <div class="main">
            <!-- Top Bar -->
            <div class="topbar">
                <!-- Toggle button -->
                <div class="toggle">
                    <i class='bx bx-menu' name="menu"></i>
                    <i class='bx bx-x' name="close"></i>
                </div>

                <!-- User profile -->
                <div class="user">
                    <!-- Theme Toggler -->
                    <div class="theme-toggler">
                        <span class="icon">
                            <i class='bx bx-sun' name="sun"></i>
                            <!-- <i class='bx bx-moon' name="moon"></i> -->
                        </span>
                    </div>
                    <div class="dropBox">
                        <div class="select-btn">
                            <span class="icon">
                                <i class='bx bx-chevron-down'></i>
                            </span>
                            <span class="user-name"><?php echo $_SESSION['ADMIN_USERNAME'] ?></span>
                            <div class="img-box"><img src="images/admin.jpg" alt=""></div>
                        </div>

                        <div class="result-box">
                            <div class="items">
                                <ul>
                                    <li><a href="logout.php"">تسجيل خروج</a><i class='bx bx-log-out-circle'></i></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container mt-5">