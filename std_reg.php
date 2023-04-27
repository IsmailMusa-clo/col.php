<?php
require('top.inc.php');
isAdmin();
$std_id = '';
$sub_id = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from std_reg where std_id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
    } else {
        header('location:students.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $std_id = get_safe_value($con, $_GET['id']);
    $sub_id = get_safe_value($con, $_POST['sub_id']);  
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
        if (isset($_GET['id']) && $_GET['id'] != '') {
            // mysqli_query($con, "update std_reg set name='$name',sub_id='$sub_id',spec='$spec' ,phone='$phone'where id='$id'");
        } else {
            mysqli_query($con, "insert into std_reg(sub_id) values('$sub_id') where std_id ='$std_id'");
        }
        header('location:students.php');
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
                    <form method="post">
                        <div class="card-body card-block">
                           
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