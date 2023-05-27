<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from exam where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

// Fetch subjects without exam date
$sql = "SELECT subjects.id, subjects.name FROM subjects LEFT JOIN exam ON subjects.id = exam.sub_id WHERE exam.sub_id IS NULL";
$result = mysqli_query($con, $sql);
$subjects = array();
while ($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

// Insert new exam into the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_date = $_POST['exam_date']; // Get the manually entered exam date
    $sub_id = $_POST['sub_id']; // Get the selected subject ID

    // Insert the new exam record into the database
    $sql = "INSERT INTO exam (exam_date, sub_id) VALUES ('$exam_date', '$sub_id')";
    mysqli_query($con, $sql);
}
?>

<div class="content pb-0" style="text-align:center">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">الاختبارات للمواد الدارسية</h4>
                        <h4 class="box-link btn btn-info"><a href="manage_dist_teach.php">توزيع الاختبارات</a></h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="exam_date">تاريخ الاختبار:</label>
                                    <input type="date" id="exam_date" name="exam_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="sub_id">اختر المادة:</label>
                                    <select id="sub_id" name="sub_id" required>
                                        <option value="">اختر المادة</option>
                                        <?php foreach ($subjects as $subject) { ?>
                                            <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">إضافة الاختبار</button>
                            </form>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>اسم المادة</th>
                                        <th>مراقب الاختبار</th>
                                        <th>تاريخ الاختبار</th>
                                        <th>فترة الاختبار</th>
                                        <th>تعديل أو حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $sql = "SELECT exam.*, subjects.name AS subject_name, teacher.name AS teacher_name FROM exam INNER JOIN subjects ON exam.sub_id = subjects.id LEFT JOIN teacher ON exam.teacher_id = teacher.id ORDER BY exam.id DESC";
                                    $res = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $date_formatted = date('Y-m-d', strtotime($row['exam_date']));
                                    ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['subject_name'] ?></td>
                                            <td>
                                                <?php
                                                // Decode the JSON string to get the invigilators array
                                                $invigilators = json_decode($row['invigilators'], true);

                                                // Display the invigilators' names
                                                foreach ($invigilators as $invigilator) {
                                                    // Get the teacher's name from the teachers table
                                                    $teacher_sql = "SELECT name FROM teacher WHERE id = $invigilator";
                                                    $teacher_result = mysqli_query($con, $teacher_sql);
                                                    $teacher_row = mysqli_fetch_assoc($teacher_result);
                                                    $teacher_name = $teacher_row['name'];

                                                    echo $teacher_name . '<br>';
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $date_formatted ?></td>
                                            <td><?php echo $row['time'] ?></td>
                                            <td>
                                                <?php
                                                echo "<span class='badge badge-edit'><a href='manage_dist_teach.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";
                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>