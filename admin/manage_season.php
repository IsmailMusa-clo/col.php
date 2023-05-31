<?php
require('top.inc.php');
isAdmin();

$start_exams = '';
$end_exams = '';
$season = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from season where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $start_exams = $row['start_exams'];
        $end_exams = $row['end_exams'];
        $season = $row['season'];
    } else {
        header('location:season.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $start_exams = get_safe_value($con, $_POST['start_exams']);
    $end_exams = get_safe_value($con, $_POST['end_exams']);
    $season = get_safe_value($con, $_POST['season']);
    if (isset($_GET['id']) && $_GET['id'] != '') {
        mysqli_query($con, "update season set start_exams='$start_exams', end_exams='$end_exams', season='$season' where id='$id'");
        echo "<script>window.location.href='season.php'</script>";
    } else {
        $res = mysqli_query($con, "select * from season where season='$season'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $msg = "Season ALREADY EXIST";
        } else {
            mysqli_query($con, "insert into season(`start_exams`,`end_exams`,`season`) values('$start_exams','$end_exams', '$season')");
            echo "<script>window.location.href='season.php'</script>";
            die();
        }
    }
}
?>

<div class="content pb-0" style="text-align:center">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">تعديل تواريخ الاختبارات</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <form method="POST" action="" class="mx-2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group row">
                                    <label for="season" class="col-sm-2 col-form-label">Season:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="season" name="season" value="<?php echo $season; ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_exams" class="col-sm-2 col-form-label">تاريخ بداية الاختبارات:</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="start_exams" name="start_exams" value="<?php echo $start_exams; ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_exams" class="col-sm-2 col-form-label">تاريخ نهاية الاختبارات:</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="end_exams" name="end_exams" value="<?php echo $end_exams; ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" name="submit" class="btn btn-primary float-start my-3">تحديث التواريخ</button>
                                </div>
                            </form>
                        </div>
                        <?=$msg?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>