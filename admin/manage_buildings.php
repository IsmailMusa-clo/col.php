<?php
require('top.inc.php');
isAdmin();

$building_name = '';
$msg = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from buildings where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $building_name = $row['name'];
    } else {
        header('location:buildings.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $building_name = get_safe_value($con, $_POST['building_name']);
    if (isset($_GET['id']) && $_GET['id'] != '') {
        mysqli_query($con, "update buildings set name='$building_name' where id='$id'");
        echo "<script>window.location.href='buildings.php'</script>";
    } else {
        $res = mysqli_query($con, "select * from buildings where name='$building_name'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $msg = "Building ALREADY EXIST";
        } else {
            mysqli_query($con, "insert into buildings(`name`) values('$building_name')");
            echo "<script>window.location.href='buildings.php'</script>";
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
                        <h4 class="box-title">  المباني الدراسية </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <form method="POST" action="" class="mx-2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group row">
                                    <label for="building_name" class="col-sm-2 col-form-label">   اسم المبنى:</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="building_name" name="building_name" value="<?php echo $building_name; ?>" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" name="submit" class="btn btn-primary float-start my-3"> تحديث البيانات</button>
                                </div>
                            </form>
                        </div>
                        <?= $msg ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer.inc.php');
?>