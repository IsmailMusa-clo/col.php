<?php
require('top.inc.php');
isAdmin();
$name = '';
$ac_year = '';
$season = '';
$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
	$id = get_safe_value($con, $_GET['id']);
	$res = mysqli_query($con, "select * from subjects where id='$id'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		$row = mysqli_fetch_assoc($res);
		$name = $row['name'];
		$ac_year = $row['ac_year'];
		$season = $row['season'];
	} else {
		header('location:subjects.php');
		die();
	}
}

if (isset($_POST['submit'])) {
	$name = get_safe_value($con, $_POST['name']);
	$ac_year = get_safe_value($con, $_POST['ac_year']);
	$season = get_safe_value($con, $_POST['season']);
	$res = mysqli_query($con, "select * from subjects where name='$name'");
	$check = mysqli_num_rows($res);
	if ($check > 0) {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			$getData = mysqli_fetch_assoc($res);
			if ($id == $getData['id']) {
			} else {
				$msg = "subject ALREADY EXIST";
			}
		} else {
			$msg = "subject ALREADY EXIST";
		}
	}

	if ($msg == '') {
		if (isset($_GET['id']) && $_GET['id'] != '') {
			mysqli_query($con, "update subjects set name='$name',ac_year='$ac_year',season='$season' where id='$id'");
		} else {
			mysqli_query($con, "insert into subjects(`name`,`ac_year`,`season`) values('$name','$ac_year','$season')");
		}
		echo "<script>window.location.href='subjects.php'</script>";
		die();
	}
}
?>
<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><strong>المساق الدارسي</strong> </div>
					<form method="post" action="">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="name" class=" form-control-label">اسم المساق</label>
								<input type="text" name="name" placeholder="ENTER CATEGORIES NAME" class="form-control" required value="<?php echo $name ?>">
							</div>
							<div class="form-group">
								<label for="ac_year" class=" form-control-label">السنة الدراسية للمساق</label>
								<input type="number" min="1" max="5" name="ac_year" placeholder="ENTER ac year" class="form-control" required value="<?php echo $ac_year ?>">
							</div>
							<div class="form-group">
								<label for="season" class=" form-control-label">الفصل الدارسي</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="season" <?php if ($season == '1') echo 'checked'; ?> id="inlineRadio1" value="1">
									<label class="form-check-label" value="1" for="inlineRadio1">الأول</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="season" id="inlineRadio2" <?php if ($season == 2) echo 'checked'; ?> value="2">
									<label class="form-check-label" value="2" for="inlineRadio2">الثاني</label>
								</div>
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