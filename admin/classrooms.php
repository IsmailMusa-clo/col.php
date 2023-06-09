<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from classrooms where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql =
    "SELECT classrooms.*, buildings.name AS building_name FROM classrooms INNER JOIN buildings ON classrooms.building_id = buildings.id ORDER BY classrooms.id DESC";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0" style="text-align:center">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body c-t">
                        <h4 class="box-title">القاعات الدراسية </h4>
                        <h4 class="box-link btn btn-info add"><a href="manage_classrooms.php">إضافة قاعة دراسية</a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>اسم القاعة</th>
                                        <th>اسم المبنى</th>
                                        <th>تعديل أو حذف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['building_name'] ?></td>
                                            <td>
                                                <?php
                                                echo "<span class='badge badge-edit'><a href='manage_classrooms.php?id=" . $row['id'] . "'>تعديل</a></span>&nbsp;";

                                                echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>حذف</a></span>";

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