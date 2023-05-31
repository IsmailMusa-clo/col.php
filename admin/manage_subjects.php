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
					<div class="card-header"><strong>المادة الدارسية</strong> </div>
					<form method="post" action="">
						<div class="card-body card-block">
							<div class="form-group">
								<label for="name" class=" form-control-label">اسم المادة</label>
								<input type="text" name="name" placeholder="ENTER CATEGORIES NAME" class="form-control" required value="<?php echo $name ?>">
							</div>
							<div class="form-group">
								<label for="ac_year" class=" form-control-label">السنة الدراسية للمادة</label>
								<input type="number" min="1" max="5" name="ac_year" placeholder="ENTER ac year" class="form-control" required value="<?php echo $ac_year ?>">
							</div>
							<div class="form-group">
								<label for="season" class=" form-control-label">الفصل الدراسي</label>
								<select name="season" required class="form-control">
									<option value="">اختر الفصل الدراسي</option>
									<?php
									$seasons_sql = "SELECT * FROM season";
									$seasons_result = mysqli_query($con, $seasons_sql);
									while ($season_row = mysqli_fetch_assoc($seasons_result)) {
										$season_id = $season_row['id'];
										$season_name = $season_row['season'];
										echo "<option value='$season_id' " . ($season_id == $season ? 'selected' : '') . ">$season_name</option>";
									}
									?>
								</select>
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