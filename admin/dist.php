<?php
include "connection.inc.php";

// قراءة جدول المساقات الدراسية المسجلة من قاعدة البيانات وتخزينه في مصفوفة
$query1 = "SELECT * FROM teach_subject";
$result1 = mysqli_query($con, $query1);
$courses = array();
while ($row = mysqli_fetch_assoc($result1)) {
    $courses[] = $row;
}
// قراءة جدول الاختبارات الدراسية من قاعدة البيانات وتخزينه في مصفوفة
$query2 = "SELECT teacher_id ,id FROM exam";
$result2 = mysqli_query($con, $query2);
$exams = array();
while ($row = mysqli_fetch_assoc($result2)) {
    $exams[] = $row;
}

// تحديد المواعيد المناسبة للاختبارات
$i = 1;
foreach ($courses as $exam) {
    $start_date = strtotime("+2 months", strtotime($exam['date']));
    $end_date = strtotime("+15 days", $start_date);
    $exam['start_date'] = date('Y-m-d', $start_date);
    $exam['end_date'] = date('Y-m-d', $end_date);
    $random_date = rand(strtotime($exam['start_date']), strtotime($exam['end_date']));
    $random_date_formatted = date('Y-m-d', $random_date);
    // print_r($random_date_formatted);
    // print_r($exam);
    $sub = $exam['sub_id'];
    $query2 = "SELECT * FROM exam WHERE sub_id='$sub'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2)) {
        echo "تم تحديد موعد الاختبار مسبقاً";
    } else {
        mysqli_query($con, "insert into exam(`sub_id`,`exam_date`) values('$sub','$random_date_formatted')");
    }

    // إنشاء مصفوفة جديدة لتخزين جدول المدرسين
    $query3 = "SELECT id FROM teacher";
    $result3 = mysqli_query($con, $query3);
    while ($row = mysqli_fetch_assoc($result3)) {
        foreach ($exams as $ex) {
            if ($row['id'] == $exam['tech_id']) {
             } else {
                $id = $ex['id'];
                echo $id;
                $t_id = $row['id'];
                mysqli_query($con, "UPDATE exam SET `teacher_id`= '$t_id'  WHERE id='$id'");
                continue;
            }
        }
        
    }

}
echo "<script>window.location.href='index.php'</script>";
