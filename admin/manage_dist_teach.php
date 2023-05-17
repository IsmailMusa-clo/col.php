<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "collage_exam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all teachers
$sql = "SELECT id FROM teacher";
$result = $conn->query($sql);
$teachers = array();
while ($row = $result->fetch_assoc()) {
    $teachers[] = $row['id'];
}

// Select all subjects and their registration dates
$sql = "SELECT id, date FROM subjects";
$result = $conn->query($sql);
$subjects = array();
while ($row = $result->fetch_assoc()) {
    $subjects[] = $row;
}

// Shuffle teachers and subjects to distribute them equally
shuffle($teachers);
shuffle($subjects);

// Assign subjects to teachers
for ($i = 0; $i < count($subjects); $i++) {
    $teacher = $teachers[$i % count($teachers)];
    $subject = $subjects[$i]['id'];
    $registration_date = $subjects[$i]['date'];

    // Check if the teacher teaches the subject
    $sql = "SELECT * FROM teach_subject WHERE tech_id = $teacher AND sub_id = $subject";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // Assign the teacher to the subject
        $time = $i % 2 == 0 ? 'first' : 'second';
        $exam_date = date('Y-m-d', strtotime($registration_date . ' + 2 months'));
        $sql = "INSERT INTO exam (exam_date, teacher_id, sub_id, time) VALUES ('$exam_date', $teacher, $subject, '$time')";
        $conn->query($sql);
    }
}

$conn->close();


echo "<script>window.location.replace('dist_teach.php')</script>";
