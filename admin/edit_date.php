<?php
require('top.inc.php');
isAdmin();

// Fetch subjects without exam date
$sql = "SELECT subjects.id, subjects.name FROM subjects LEFT JOIN exam ON subjects.id = exam.sub_id";
$result = mysqli_query($con, $sql);
$subjects = array();
while ($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_date = $_POST['exam_date']; // Get the manually entered exam date
    $sub_id = $_POST['sub_id']; // Get the selected subject ID
    $exam_id = $_POST['exam_id']; // Get the exam ID for the record to be updated

    // Update the exam record in the database
    $sql = "UPDATE exam SET exam_date = '$exam_date', sub_id = '$sub_id' WHERE id = '$exam_id'";
    mysqli_query($con, $sql);
    echo "<script>window.location.replace('dist_teach.php')</script>";
    // Redirect to the exams page after updating
    exit();
}

// Fetch exam details for editing
if (isset($_GET['id'])) {
    $exam_id = get_safe_value($con, $_GET['id']);
    $edit_sql = "SELECT * FROM exam WHERE id = '$exam_id'";
    $edit_result = mysqli_query($con, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);
}

?>
<div class="content pb-0" style="text-align:center">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">تعديل تاريخ الاختبار</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <form method="POST" action="" class="mx-2">
                                <input type="hidden" name="exam_id" value="<?php echo $edit_row['id']; ?>">
                                <div class="form-group row">
                                    <label for="exam_date" class="col-sm-2 col-form-label">تاريخ الاختبار:</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="exam_date" name="exam_date" value="<?php echo $edit_row['exam_date']; ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sub_id" class="col-sm-2 col-form-label">اختر المادة:</label>
                                    <div class="col-sm-10">
                                        <select id="sub_id" name="sub_id" required class="form-control">
                                            <option value="">اختر المادة</option>
                                            <?php foreach ($subjects as $subject) { ?>
                                                <option value="<?php echo $subject['id']; ?>" <?php if ($edit_row['sub_id'] == $subject['id']) echo 'selected'; ?>><?php echo $subject['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" class="btn btn-primary float-start my-3">تحديث التاريخ</button>
                                </div>
                            </form>
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