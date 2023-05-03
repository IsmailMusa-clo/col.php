<?php
require('top.inc.php');
isAdmin();
$name = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = get_safe_value($con, $_GET['id']);
	$res = mysqli_query($con, "select * from teacher where id='$id'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$name = $row['name'];
	} else {
		header('location:teachers.php');
		die();
	}
}

if (isset($_POST['submit'])) {
	$name = get_safe_value($con, $_POST['name']);

	$res = mysqli_query($con, "select * from teacher where name='$name'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($res);
			if ($id == $getData['id']) {
			} else {
				$msg = "teacher ALREADY EXIST";
			}
		} else {
			$msg = "teacher ALREADY EXIST";
		}
	}

	if ($msg == '') {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			mysqli_query($con, "update teacher set name='$name' where id='$id'");
		} else {
			mysqli_query($con, "insert into teacher(name) values('$name')");
		}
		ob_start();
		// header('location:manage_teachers.php');
		echo "<script>window.location.href='teachers.php'</script>";
		die();
	}
}
?>
<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>المدرس</strong> </div>
					<form method="post">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="name" class=" form-control-label">اسم المدرس</label>
								<input type="text" name="name" placeholder="ENTER  NAME" class="form-control" required value="<?php echo $name ?>">
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