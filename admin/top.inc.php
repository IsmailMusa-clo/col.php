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
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <title>لوحة التحكم</title>
    <!-- Icons -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <link href="assets/css/dest/style.css" rel="stylesheet">
    <style>
        .container::after {
            display: none !important;
        }

        .card {
            padding: 10px 20px;
            border-radius: 8px;
        }

        .table {
            text-align: right;
        }

        .badge-edit {
            background: #e1e1e1;
            padding: 10px;
            font-size: 15px;
            border-radius: 8px;
        }

        .badge-edit a {
            color: #010101 !important;

        }

        .badge-delete {
            background: red;
            padding: 10px;
            font-size: 15px;
            border-radius: 8px;
        }

        .badge-delete a {
            color: #fff !important;

        }

        .add {
            border-radius: 5px;
        }

        .add a {
            color: #fff;
        }

        .c-t {
            display: flex;
            justify-content: space-between;
        }

        .box-title{
            color:blue;
            font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
       
        }
    </style>

</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container" style="display:flex;justify-content:space-between">
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-left">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down"><?= $_SESSION['ADMIN_USERNAME'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="logout.php"><i class="fa fa-lock"></i> خروج</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="icon-speedometer"></i> لوحة التحكم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="season.php"><i class="icon-docs"></i> الفصول الدراسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="subjects.php"><i class="icon-docs"></i>المواد الدراسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dist_teach.php"><i class="icon-clock"></i> تحديد مواعيد الاختبارات </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="teachers.php">
                        <i class="icon-people"></i>المهندسين
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="subject_reg.php">
                        <i class="icon-docs"></i> تسجيل المواد الدراسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buildings.php">
                        <i class="icon-docs"></i>      المباني
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="classrooms.php">
                        <i class="icon-docs"></i>      القاعات الدراسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact_us.php">
                        <i class="icon-people"></i>طلبات التواصل
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main ">
        <div class="container" style="margin-top:3%">