<?php
require('top.inc.php');
isAdmin();
$student_id='';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $student_id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from students where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $ac_year = $row['ac_year'];
     } else {
        header('location:students.php');
        die();
    }
}


if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from std_reg where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from std_reg  where $student_id ='$student_id'";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">المساقات المسجلة للسنة الدراسية </h4>
                        <h4 class="box-link btn btn-info"><a href="std_reg.php">إضافة مساق</a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>اسم المساق</th>
                                        <th>السنة الدراسية للمادة</th>
                                        <th>تاريخ تسجيل المادة </th>
                                        <th>حذف </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $sql_sub = "select * from subjects  where id ='" . $row['sub_id'] . "'";
                                        $res_sub = mysqli_query($con, $sql_sub);
                                        $year = date("Y", strtotime($row['date']));
                                        while ($row_sub = mysqli_fetch_assoc($res_sub)) {
                                                $subject_name = $row_sub['name'];
                                    ?>
                                                <tr>
                                                    <td class="serial"><?php echo $i ?></td>
                                                    <td><?php echo $subject_name ?></td>
                                                    <td><?php echo $row_sub['ac_year'] ?></td>
                                                    <td><?php echo $year ?></td>
                                                    <td>
                                                        <?php
                                                        echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                    <?php $i++;
                                            
                                        }
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