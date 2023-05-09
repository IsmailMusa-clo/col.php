<?php
    include "connection.inc.php";
// function choose_random_element($array, $selected_elements = array()) {
//     // إزالة العناصر التي تم اختيارها بالفعل
//     $available_elements = array_diff($array, $selected_elements);
//     // التحقق من عدم تكرار العنصر المختار
//     if (count($available_elements) > 0) {
//         $random_key = array_rand($available_elements);
//         $random_element = $available_elements[$random_key];
//         // إضافة العنصر المختار إلى مصفوفة العناصر المختارة
//         $selected_elements[] = $random_element;
//         return array('element' => $random_element, 'selected_elements' => $selected_elements);
//     } else {
//         return array('element' => null, 'selected_elements' => $selected_elements);
//     }
// }
// $sql = "select * from teach_subject order by id desc";
// $res = mysqli_query($con, $sql);
//  $my_array = $res;
// $selected_elements = array();
// $random_result = choose_random_element($my_array, $selected_elements);
// while ($random_result['element'] != null) {
//     echo "العنصر العشوائي المختار هو: " . $random_result['element'] . "<br>";
//     $selected_elements = $random_result['selected_elements'];
//     $random_result = choose_random_element($my_array, $selected_elements);
// }

// function choose_random_element($array) {
//     $random_key = array_rand($array);
//     $random_element = $array[$random_key];
//     return $random_element;
// }

// // مثال على استخدام الدالة
// $my_array = array("apple", "banana", "orange", "grape", "watermelon");
// $random_element = choose_random_element($my_array);
// echo "العنصر العشوائي المختار هو: " . $random_element;



// // استعلام يسترد جميع السجلات من جدول المساقات الدراسية المسجلة
// $sql = "SELECT * FROM teach_subject";
// $result = $conn->query($sql);

// // تخزين النتائج في مصفوفة
// $courses = array();

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         // إضافة النتيجة إلى المصفوفة
//         $courses[] = $row;
//     }
// }


// // استعلام يسترد جميع السجلات من جدول الاختبارات الدراسية
// $sql = "SELECT * FROM exams";
// $result = $conn->query($sql);

// // تخزين النتائج في مصفوفة
// $exams = array();

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         // إضافة النتيجة إلى المصفوفة
//         $exams[] = $row;
//     }
// }

// // مصفوفة تحتوي على الأيام المتاحة للأخذ في الاختبارات
// $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

// // مصفوفة تحتوي على المدرسين المتاحين لإدارة الاختبارات
// $teachers = array("Teacher A", "Teacher B", "Teacher C", "Teacher D", "Teacher E");

// // مصفوفة تحتوي على المواد الدراسية المتاحة للإختبار
// $subjects = array();

// حل

// // الحصول على جميع المدرسين
// $query = "SELECT * FROM teacher";
// $teachersResult = mysqli_query($conn, $query);
// $teachers = mysqli_fetch_all($teachersResult, MYSQLI_ASSOC);

// // الحصول على جميع المواد الدراسية
// $query = "SELECT * FROM subjects";
// $coursesResult = mysqli_query($conn, $query);
// $courses = mysqli_fetch_all($coursesResult, MYSQLI_ASSOC);

// // الحصول على جميع مواعيد الاختبارات الدراسية
// $query = "SELECT * FROM exam ORDER BY exam_date ASC";
// $examsResult = mysqli_query($conn, $query);
// $exams = mysqli_fetch_all($examsResult, MYSQLI_ASSOC);

// // ترتيب المواعيد الدراسية بترتيب تتابعي
// $days = array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
// $examsByDay = array();
// foreach ($days as $day) {
//     $examsByDay[$day] = array();
//     foreach ($exams as $exam) {
//         if (date('l', strtotime($exam['exam_date'])) == $day) {
//             $examsByDay[$day][] = $exam;
//         }
//     }
// }

// // توزيع المدرسين على المواعيد الدراسية
// $teacherCount = count($teachers);
// foreach ($examsByDay as $day => $examsOfDay) {
//     foreach ($examsOfDay as $key => $exam) {
//         $courseID = $exam['sub_id'];
//         $teacherID = $exam['teacher_id'];
//         // الحصول على جميع مواعيد الاختبارات الدراسية للمدرس
//         $query = "SELECT * FROM exams WHERE teacher_id = $teacherID AND exam_date != '{$exam['exam_date']}'";
//         $teacherExamsResult = mysqli_query($conn, $query);
//         $teacherExams = mysqli_fetch_all($teacherExamsResult, MYSQLI_ASSOC);
//         // الحصول على جميع المواد الدراسية التي يدرسها المدرس
//         $query = "SELECT * FROM teach_subject WHERE tech_id = $teacherID";
//         $teacherCoursesResult = mysqli_query($conn, $query);
//         $teacherCourses = mysqli_fetch_all($teacherCoursesResult, MYSQLI_ASSOC);
//         // التحقق من عدم وجود المدرس في الاختبارات الدراسية الأخرى في نفس اليوم

//     }
// }


// قراءة جدول المساقات الدراسية المسجلة من قاعدة البيانات وتخزينه في مصفوفة
$query1 = "SELECT * FROM teach_subject";
$result1 = mysqli_query($con, $query1);
$courses = array();
while ($row = mysqli_fetch_assoc($result1)) {
    $courses[] = $row;

}

// قراءة جدول الاختبارات الدراسية من قاعدة البيانات وتخزينه في مصفوفة
$query2 = "SELECT * FROM exam";
$result2 = mysqli_query($con, $query2);
$exams = array();
while ($row = mysqli_fetch_assoc($result2)) {
    $exams[] = $row;

}

// إنشاء مصفوفة جديدة لتخزين جدول المدرسين
$query3 = "SELECT * FROM exam";
$result3 = mysqli_query($con, $query3);
$teachers = array();
while ($row = mysqli_fetch_assoc($result3)) {
    $teachers[] = $row;
}
 
// تحديد المواعيد المناسبة للاختبارات
$i=1;
foreach ($courses as $exam) {
    $start_date = strtotime("+2 months", strtotime($exam['date']));
    $end_date = strtotime("+15 days", $start_date);
    $exam['start_date'] = date('Y-m-d', $start_date);
    $exam['end_date'] = date('Y-m-d', $end_date);
    $random_date = rand(strtotime($exam['start_date']), strtotime($exam['end_date']));
    $random_date_formatted = date('Y-m-d', $random_date);
    print_r($random_date_formatted);
    print_r($exam);
    $sub=$exam['sub_id'];
    $query2 = "SELECT * FROM exam WHERE sub_id='$sub'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2)) {
        echo "تم تحديد موعد الاختبار مسبقاً";
    }else{
        mysqli_query($con, "insert into exam(`sub_id`,`exam_date`) values('$sub','$random_date_formatted')");

    }
    // توزيع المدرسين على الاختبارات الدراسية
    $teacher_assigned = false;
    while (!$teacher_assigned) {
        $teacher_index = array_rand($teachers);
        var_dump($teachers);
        $assigned_courses = array_column($teachers[$teacher_index]['exams'], 'course_id');
        if (!in_array($exam['course_id'], $assigned_courses)) {
            $teachers[$teacher_index]['exams'][] = $exam;
            $teacher_assigned = true;
        }
    }
}

// تحديث جدول الاختبارات الدراسية في قاعدة البيانات
foreach ($teachers as $teacher) {
    foreach ($teacher['exams'] as $exam) {
        echo $teacher['id'];
        $query3 = "UPDATE exam SET teacher_id = {$teacher['id']}, date = '{$exam['start_date']}' WHERE id = {$exam['id']}";
        mysqli_query($connection, $query3);
    }
}


?>
