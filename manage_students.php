<?php
require('top.inc.php');
isAdmin();
$name = '';
$spec = '';
$ac_year = '';
$phone = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = get_safe_value($con, $_GET['id']);
	$res = mysqli_query($con, "select * from students where id='$id'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$name = $row['name'];
		$spec = $row['spec'];
		$ac_year = $row['ac_year'];
		$phone = $row['phone'];
	} else {
		header('location:students.php');
		die();
	}
}
if (isset($_POST['submit'])) {
	$name = get_safe_value($con, $_POST['name']);
	$spec = get_safe_value($con, $_POST['spec']);
	$ac_year = get_safe_value($con, $_POST['ac_year']);
	$phone = get_safe_value($con, $_POST['phone']);
	$res = mysqli_query($con, "select * from students where name='$name'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($res);
			if ($id == $getData['id']) {
			} else {
				$msg = "students ALREADY EXIST";
			}
		} else {
			$msg = "students ALREADY EXIST";
		}
	}

	if ($msg == '') {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			mysqli_query($con, "update students set name='$name',ac_year='$ac_year',spec='$spec' ,phone='$phone' where id='$id'");
		} else {
			mysqli_query($con, "insert into students(name,ac_year,spec,phone) values('$name','$ac_year','$spec','$phone')");
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
					<form method="post">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="name" class=" form-control-label">اسم الطالب</label>
								<input type="text" name="name" placeholder="ENTER  NAME" class="form-control" required value="<?php echo $name ?>">
							</div>
							<div class="form-group">
								<label for="ac_year" class=" form-control-label">السنة الدراسية للطالب</label>
								<input type="number" min="1" max="5" name="ac_year" placeholder="ENTER ac year " class="form-control" required value="<?php echo $ac_year ?>">
							</div>
							<div class="form-group">
								<label for="phone" class=" form-control-label">رقم الهاتف</label>
								<input type="text" name="phone" placeholder="ENTER  phone " class="form-control" required value="<?php echo $phone ?>">
							</div>

							<div class="form-group">
								<label for="phone" class=" form-control-label">التخصص</label>
								<input type="text" name="spec" placeholder="ENTER  spec " class="form-control" required value="<?php echo $spec ?>">
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