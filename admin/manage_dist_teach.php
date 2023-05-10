<?php

require('top.inc.php');
isAdmin();
$exam_id = '';
$exam_date = '';
$teach_id = '';
$sub_id = '';
$msg = '';
$query3 = "SELECT * FROM teacher";
$result3 = mysqli_query($con, $query3);
$query4 = "SELECT * FROM exam";
$result4 = mysqli_query($con, $query4);

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from exam where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $exam_date = $row['exam_date'];
        $date_formatted = date('Y-m-d', strtotime($row['exam_date']));
        $teach_id = $row['teacher_id'];
        $sub_id = $row['sub_id'];
    } else {
        header('location:dist_teach.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $teach_id = get_safe_value($con, $_POST['teach_id']);
    $sub_id = get_safe_value($con, $_POST['sub_id']);
    $date_exam = get_safe_value($con, $_POST['date_exam']);
    $res = mysqli_query($con, "select * from exam where sub_id='$sub_id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "subject ALREADY EXIST";
            }
        } else {
            $msg = "subject ALREADY EXIST";
        }
    }
    $res1 = mysqli_query($con, "select * from teach_subject WHERE tech_id='$teach_id' and sub_id='$sub_id'");
    $check1 = mysqli_num_rows($res1);
    if ($check1 > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res1);
            if ($id == $getData['id']) {
            } else {
                $msg = "هذا المدرس لا يصلح للمراقبة على هذا المساق";
            }
        } else {
            $msg = "هذا المدرس لا يصلح للمراقبة على هذا المساق";
        }
    }
    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update exam set teacher_id='$teach_id',sub_id='$sub_id',exam_date='$date_exam' where id='$id'");
        } else {
            mysqli_query($con, "insert into exam(`teacher_id`,`sub_id`,`exam_date`) values('$teach_id','$sub_id','$date_exam')");
        }
        echo "<script>window.location.href='dist_teach.php'</script>";
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
                                <label for="name" class=" form-control-label">المساق </label>
                                <select class="form-select" name="sub_id" aria-label="Default select example">
                                    <option selected>اختر المادة     </option>
                                    <?php 
                                    $query5 = "SELECT * FROM subjects";
                                        $result5 = mysqli_query($con, $query5);
                                        while ($row = mysqli_fetch_assoc($result5)) { 
                                        if ($row['id']==$sub_id) {
                                            echo 
                                            "<option value='".$row['id']."' selected>".$row['name']."</option>";
                                        }
                                        ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">اسم المدرس</label>
                                <select class="form-select" name="teach_id" aria-label="Default select example">
                                    <option >اختر</option>
                                    <?php while ($row = mysqli_fetch_assoc($result3)) { 
                                        
                                        if ($row['id']==$teach_id) {
                                            echo 
                                            "<option value='".$row['id']."' selected>".$row['name']."</option>";
                                        }
                                        ?>
                                            
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select> <input type="hidden" name="id" placeholder="ENTER  NAME" class="form-control" required value="<?php echo $std_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">موعد الاختبار</label>
                                <input type="date" name="date_exam" placeholder="اختر موعد الاختبار" value="<?= $date_formatted?>" class="form-control" required >
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