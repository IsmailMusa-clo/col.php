<?php
include "admin/connection.inc.php";
if (!isset($_SESSION['EMP_LOGIN'])) {
    header("Location: login_emp.php");
    exit();
}

$teacher_id = $_SESSION['EMP_ID'];
$sql = "SELECT e.*, s.name AS subject_name, c.name AS classroom_name
FROM exam e
INNER JOIN subjects s ON e.sub_id = s.id
LEFT JOIN classrooms c ON e.classroom_id = c.id
WHERE e.invigilators LIKE '%$teacher_id%'";

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
                    <?= $_SESSION['EMP_USERNAME'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="teacher_subjects.php"> التدريس</a></li>
                    <li><a class="dropdown-item" href="teacher_dash.php">المراقبة</a></li>
                    <li><a class=" dropdown-item" href="logout.php">تسجيل الخروج</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>المواد الدراسية التي سوف تراقب عليها</h2>
                <div class="table-stats order-table ov-h">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="serial">#</th>
                                <th>اسم المساق</th>
                                <th>تاريخ تدريس المادة</th>
                                <th>مراقبي الاختبار</th>
                                <th>القاعة</th>
                                <th>موعد الاختبار</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $subject_id = $row['sub_id'];
                                $subject_name = $row['subject_name'];
                                $teach_date = date("Y-m-d", strtotime($row['date']));
                                $classroom_name = $row['classroom_name'];

                                $sql_ex = "SELECT * FROM exam WHERE sub_id = '$subject_id' AND invigilators IS NOT NULL";
                                $res_ex = mysqli_query($con, $sql_ex);

                                while ($row_ex = mysqli_fetch_assoc($res_ex)) {
                                    $invigilators = json_decode($row_ex['invigilators'], true);

                                    echo "<tr>";
                                    echo "<td class='serial'>" . $i . "</td>";
                                    echo "<td>" . $subject_name . "</td>";
                                    echo "<td>" . $teach_date . "</td>";
                                    echo "<td>";
                                    foreach ($invigilators as $invigilator) {
                                        $teacher_sql = "SELECT name FROM teacher WHERE id = '$invigilator'";
                                        $teacher_result = mysqli_query($con, $teacher_sql);
                                        $teacher_row = mysqli_fetch_assoc($teacher_result);
                                        $teacher_name = $teacher_row['name'];

                                        echo $teacher_name . "<br>";
                                    }
                                    echo "</td>";
                                    echo "<td>" . $classroom_name . "</td>";
                                    echo "<td>" . date("y-m-d", strtotime($row_ex['exam_date'])) . "</td>";
                                    echo "</tr>";

                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>