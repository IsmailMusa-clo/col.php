<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from teach_subject where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select * from teach_subject order by id desc";
$res = mysqli_query($con, $sql);

?>
<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body ">
                        <h4 class="box-title">المواد المسجلة للسنة الدراسية </h4>
 
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>اسم المادة الدارسية</th>
                                        <th>مهندس المادة</th>
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
                                        $sql_teach = "select name from teacher  where id ='" . $row['tech_id'] . "'";
                                        $res_teach = mysqli_query($con, $sql_teach);
                                        $year = date("Y", strtotime($row['date']));
                                        while ($row_sub = mysqli_fetch_assoc($res_sub)) {
                                            while ($row_teach = mysqli_fetch_assoc($res_teach)) {
                                                $subject_name = $row_sub['name'];
                                                $teacher_name = $row_teach['name'];
                                    ?>
                                                <tr>
                                                    <td class="serial"><?php echo $i ?></td>
                                                    <td><?php echo $subject_name ?></td>
                                                    <td><?php echo $teacher_name ?></td>
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