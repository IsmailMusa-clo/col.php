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

$sql = "select * from exam order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0" style="text-align:center">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title"> الاختبارات للمساقات الدارسية  </h4>
                        <h4 class="box-link btn btn-info"><a href="manage_dist_teach.php">إضافة اختبار جديد</a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>اسم المساق</th>
                                        <th>مراقب الاختبار</th>
                                        <th>تاريخ الاختبار</th>
                                        <th>تعديل أو حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $sub=$row['sub_id'];
                                        $query5 = "SELECT name FROM subjects where id='$sub'";
                                        $result5 = mysqli_query($con, $query5);
                                        $row_result5 = mysqli_fetch_assoc($result5);
                                        $teacher=$row['teacher_id'];
                                        $query6 = "SELECT name FROM teacher where id='$teacher'";
                                        $result6 = mysqli_query($con, $query6);
                                        $row_result6 = mysqli_fetch_assoc($result6);
                                        $date_formatted = date('Y-m-d', strtotime($row['exam_date']));
                                        ?>
                                        
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row_result5['name'] ?></td>
                                            <td><?php echo $row_result6['name'] ?></td>
                                            <td><?php echo $date_formatted ?></td>
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