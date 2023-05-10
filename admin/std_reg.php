<?php
require('top.inc.php');
isAdmin();
$std_id = '';
$sub_id = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from students where id='$id'");
     $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
         $name = $row['name'];
        $std_id = $row['id'];
        $ac_year=$row['ac_year'];
        $res_subject = mysqli_query($con, "select * from subjects");
    } else {
        echo "<script>window.location.href='students.php'</script>";
        die();
    }
}

if (isset($_POST['submit'])) {
    $std_id = get_safe_value($con, $_POST['id']);
    $sub_id = get_safe_value($con, $_POST['sub_id']);
    $res_sub = mysqli_query($con, "select ac_year from subjects where id='$sub_id'");
    $row_sub = mysqli_fetch_assoc($res_sub);
    $res_sub_year=$row_sub['ac_year'];
    $res = mysqli_query($con, "select * from std_reg where sub_id='$sub_id' && std_id='$std_id' ");
    $check = mysqli_num_rows($res);
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
            if ($res_sub_year>=$ac_year) {
                echo "<script>window.alert('هذا المساق غير متاح لك')</script>";
            }else{
            mysqli_query($con, "insert into std_reg(`std_id`,`sub_id`) values('$std_id','$sub_id')");
         // }
            }
        echo "<script>window.location.href='students.php'</script>";
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
                                <label for="name" class=" form-control-label">اسم الطالب</label>
                                <input type="text" name="name" placeholder="ENTER  NAME"  class="form-control" required value="<?php echo $name ?>">
                                <input type="hidden" name="id" placeholder="ENTER  NAME"  class="form-control" required value="<?php echo $std_id ?>">
                            </div>
                            <div class="form-group">
                                <label for="name" class=" form-control-label">المادة الدراسية </label>
                                <select class="form-select" name="sub_id" aria-label="Default select example">
                                    <option selected>اختر المادة التي تريد تسجيلها</option>
                                    <?php while ($row = mysqli_fetch_assoc($res_subject)) { ?>
                                        <option value="<?=$row['id']?>" ><?= $row['name'] ?></option>
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