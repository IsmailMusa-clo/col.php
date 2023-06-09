<?php
require('top.inc.php');

// Count records in contact_us table
$contactUsCountSql = "SELECT COUNT(*) AS total_contacts FROM contact_us";
$contactUsCountResult = mysqli_query($con, $contactUsCountSql);
$contactUsCountRow = mysqli_fetch_assoc($contactUsCountResult);
$totalContacts = $contactUsCountRow['total_contacts'];
// Count records in building table
$buildingsCountSql = "SELECT COUNT(*) AS buildings FROM buildings";
$buildingsCountResult = mysqli_query($con, $buildingsCountSql);
$buildingsountRow = mysqli_fetch_assoc($buildingsCountResult);
$totalbuildings = $buildingsountRow['buildings'];
// Count records in classrooms table
$classroomsCountSql = "SELECT COUNT(*) AS classrooms FROM classrooms";
$classroomsCountResult = mysqli_query($con, $classroomsCountSql);
$classroomsountRow = mysqli_fetch_assoc($classroomsCountResult);
$totalclassrooms = $classroomsountRow['classrooms'];

// Count records in exam table
$examCountSql = "SELECT COUNT(*) AS total_exams FROM exam";
$examCountResult = mysqli_query($con, $examCountSql);
$examCountRow = mysqli_fetch_assoc($examCountResult);
$totalExams = $examCountRow['total_exams'];

// Count records in subjects table
$subjectsCountSql = "SELECT COUNT(*) AS total_subjects FROM subjects";
$subjectsCountResult = mysqli_query($con, $subjectsCountSql);
$subjectsCountRow = mysqli_fetch_assoc($subjectsCountResult);
$totalSubjects = $subjectsCountRow['total_subjects'];

// Count records in teacher table
$teacherCountSql = "SELECT COUNT(*) AS total_teachers FROM teacher";
$teacherCountResult = mysqli_query($con, $teacherCountSql);
$teacherCountRow = mysqli_fetch_assoc($teacherCountResult);
$totalTeachers = $teacherCountRow['total_teachers'];

// Count records in teach_subject table
$teachSubjectCountSql = "SELECT COUNT(*) AS total_teach_subjects FROM teach_subject";
$teachSubjectCountResult = mysqli_query($con, $teachSubjectCountSql);
$teachSubjectCountRow = mysqli_fetch_assoc($teachSubjectCountResult);
$totalTeachSubjects = $teachSubjectCountRow['total_teach_subjects'];
?>


<div class="content pb-0">
	<div class="orders">
		<div class="row">
			<div class="col-xl-12">
				<div class="card card-inverse card-info">
					<div class="card-body">
						<h4 class="box-title" style="text-align: center;">احصائيات لوحة التحكم</h4>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="card card-inverse card-danger">
					<div class="card-body">
						<h5 class="card-title">عدد الرسائل الواردة</h5>
						<p class="card-text"><?php echo $totalContacts; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card card-inverse card-success">
					<div class="card-body">
						<h5 class="card-title">عدد الاختبارات</h5>
						<p class="card-text"><?php echo $totalExams; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card card-inverse card-danger">
					<div class="card-body">
						<h5 class="card-title">عدد المواد الدراسية</h5>
						<p class="card-text"><?php echo $totalSubjects; ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="card card-inverse card-success">
					<div class="card-body">
						<h5 class="card-title">عدد المعلمين</h5>
						<p class="card-text"><?php echo $totalTeachers; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-inverse card-success">
					<div class="card-body">
						<h5 class="card-title">عدد تدريس المواد</h5>
						<p class="card-text"><?php echo $totalTeachSubjects; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-inverse card-danger">
					<div class="card-body">
						<h5 class="card-title">عدد المباني</h5>
						<p class="card-text"><?php echo $totalbuildings; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card card-inverse card-danger">
					<div class="card-body">
						<h5 class="card-title">عدد  القاعات</h5>
						<p class="card-text"><?php echo $totalclassrooms; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
require('footer.inc.php');
?>