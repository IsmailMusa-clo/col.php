<?php
require('top.inc.php');
isAdmin();
if (isset($_GET['type']) && $_GET['type'] != '') {
	$type = get_safe_value($con, $_GET['type']);
	if ($type == 'delete') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from students where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}

$sql = "select * from students order by id desc";
$res = mysqli_query($con, $sql);
?>
<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">الطلاب </h4>
						<h4 class="box-link btn btn-info"><a href="manage_students.php">إضافة طالب</a> </h4>

					</div>
					<div class="card-body--">
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>اسم الطالب</th>
										<th>التخصص</th>
										<th>السنة الدارسية</th>
										<th>رقم الجوال</th>
										<th>التاريخ </th>
										<th>حذف أو تعديل</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									while ($row = mysqli_fetch_assoc($res)) { ?>
										<tr>
											<td class="serial"><?php echo $i ?></td>
											<td><?php echo $row['name'] ?></td>
											<td><?php echo $row['spec'] ?></td>
											<td><?php echo $row['ac_year'] ?></td>
											<td><?php echo $row['phone'] ?></td>
											<td><?php echo $row['date'] ?></td>
											<td>
												<?php
												echo "<span class='badge badge-edit'><a href='std_reg.php?id=" . $row['id'] . "'>تسجيل مادة</a></span>&nbsp;";
												echo "<span class='badge badge-edit'><a href='manage_students.php?id=" . $row['id'] . "'>Edit</a></span>&nbsp;";
												echo "<span class='badge badge-delete'><a href='?type=delete&id=" . $row['id'] . "'>Delete</a></span>";
												?>
											</td>
										</tr>
									<?php $i++;} ?>
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