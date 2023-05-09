<?php
include "admin/connection.inc.php";
// session_start();
if (!isset($_SESSION['STD_LOGIN'])) {
?>
    <script>
        window.location.href = 'login_std.php';
    </script>
<?php
}
$student_id = $_SESSION['STD_ID'];
$sql = "select * from std_reg  where std_id ='$student_id'";
$res = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8">
    <title>لوحة تحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
    <!-- النافبار -->
    <nav class="navbar navbar-expand-lg py-3 bg-light">
        <div class="container">
            <a class="navbar-brand"><img width="160" src="carousel/logo.svg" alt=""></a>
            <div class="navbar-nav">

                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['STD_USERNAME'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="logout.php">تسجيل الخروج</a></li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <h2>المواد الدراسية المسجلة والاختبارات</h2>
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>اسم المساق</th>
                                <th>السنة الدراسية للمادة</th>
                                <th>تاريخ تسجيل المادة </th>
                                <th>موعد الاختبار</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $date="";
                                $sql_sub = "select * from subjects  where id ='" . $row['sub_id'] . "'";
                                $res_sub = mysqli_query($con, $sql_sub);
                                $year = date("Y", strtotime($row['date']));
                                while ($row_sub = mysqli_fetch_assoc($res_sub)) {
                                    $subject_name = $row_sub['name'];
                                    $sql_ex = "select * from exam  where sub_id ='" . $row_sub['id'] . "'";
                                    $res_ex = mysqli_query($con, $sql_ex);
                                    while ($row_ex = mysqli_fetch_assoc($res_ex)) {
                                        $date = date("Y-M-D", strtotime($row_ex['exam_date']));
                                    }
                            ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $subject_name ?></td>
                                            <td><?php echo $row_sub['ac_year'] ?></td>
                                            <td><?php echo $year ?></td>
                                            <td><?php $date   ?></td>
                                        </tr>
                            <?php $i++;
                                    }
                                
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>