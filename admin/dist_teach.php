<?php

require('top.inc.php');
isAdmin();
$exam_id = '';
$teach_id = '';
$sub_id = '';
$msg = '';
$query3 = "SELECT * FROM teacher";
$result3 = mysqli_query($con, $query3);
$query4 = "SELECT * FROM exam";
$result4 = mysqli_query($con, $query4);
// $sql = "SELECT * FROM table_name WHERE column_name <> 'value'";

if (isset($_POST['submit'])) {
    $teach_id = get_safe_value($con, $_POST['teach_id']);
     $exam_id = get_safe_value($con, $_POST['exam_id']);
    $res = mysqli_query($con, "select * from exam where teacher_id='$teach_id' && id='$exam_id' ");
    $res1 = mysqli_query($con, "select * from teach_subject where tech_id='$teach_id'");
    $check = mysqli_num_rows($res);
    $check1 = mysqli_num_rows($res1);
    
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "students ALREADY register this subjects";
            }
        } else {
            $msg = "students ALREADY register this subjects";
        }
    }

    if ($msg == '') {
        // if (isset($_GET['id']) && $_GET['id'] != '') {
        //     // mysqli_query($con, "update std_reg set name='$name',sub_id='$sub_id',spec='$spec' ,phone='$phone'where id='$id'");
        // } else {
        if ($res_sub_year >= $ac_year) {
            echo "<script>window.alert('هذا المساق غير متاح لك')</script>";
        } else {
            mysqli_query($con, "UPDATE exam SET `teacher_id`= '$teach_id'  WHERE id='$exam_id'");
            // }
        }
        echo "<script>window.location.href='index.php'</script>";
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>الطالب</strong> </div>
                    <form method="post" action="">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="name" class=" form-control-label">اسم المدرس</label>
                                <select class="form-select" name="teach_id" aria-label="Default select example">
                                    <option selected>اختر </option>
                                    <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> <input type="hidden" name="id" placeholder="ENTER  NAME" class="form-control" required value="<?php echo $std_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">المساق </label>
                                <select class="form-select" name="exam_id" aria-label="Default select example">
                                    <option selected>اختر المادة التي يريد المراقبة عليها </option>
                                    <?php while ($row = mysqli_fetch_assoc($result4)) {
                                        $sub=$row['sub_id'];
                                        $query5 = "SELECT name FROM subjects WHERE id ='$sub'";
                                        $result5 = mysqli_query($con, $query5);
                                        $row_result5 = mysqli_fetch_assoc($result5);
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row_result5['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>