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

if (isset($_GET['season']) && $_GET['season'] != '') {
    $season_id = $_GET['season'];

    // Fetch the start and end exams dates for the selected season
    $season_sql = "SELECT * FROM season WHERE id = $season_id";
    $season_result = mysqli_query($conn, $season_sql);
    $season_row = mysqli_fetch_assoc($season_result);
    $start_exams = $season_row['start_exams'];
    $end_exams = $season_row['end_exams'];

    // Fetch all subjects from exam table without assigned invigilators and time
    $subjects_sql = "SELECT id, name FROM subjects WHERE id NOT IN (SELECT sub_id FROM exam WHERE invigilators IS NOT NULL AND time IS NOT NULL) AND season = $season_id";
    $subjects_result = mysqli_query($conn, $subjects_sql);
    $subjects = array();
    while ($row = mysqli_fetch_assoc($subjects_result)) {
        $subjects[] = $row;
    }


    foreach ($subjects as $subject) {
        $sub_id = $subject['id'];

        // Select teachers who do not teach the subject
        $teachers_sql = "SELECT teacher.id FROM teacher LEFT JOIN teach_subject ON teacher.id = teach_subject.tech_id AND teach_subject.sub_id = $sub_id WHERE teach_subject.id IS NULL";
        $teachers_result = $conn->query($teachers_sql);
        $teachers = array();
        while ($row = $teachers_result->fetch_assoc()) {
            $teachers[] = $row['id'];
        }

        // Shuffle teachers
        shuffle($teachers);

        // Assign invigilators to the subject
        $time = 'first'; // Set the default time as 'first'
        $invigilators = array();

        for ($i = 0; $i < 2; $i++) {
            $teacher = $teachers[$i];
            $invigilators[] = $teacher; // Add the teacher to the invigilators array

            $time = 'second'; // Change the time to 'second' for the second invigilator
        }

        // Convert the invigilators array to JSON
        $invigilators_json = json_encode($invigilators);

        // Generate a random date within the start and end exams dates
        $exam_date = date("Y-m-d", mt_rand(strtotime($start_exams), strtotime($end_exams)));

        // Update the exam record with the selected subject, time, invigilators, and exam date
        $sql = "INSERT INTO exam (sub_id, time, invigilators, exam_date) VALUES ('$sub_id', '$time', '$invigilators_json', '$exam_date')";
        $conn->query($sql);
    }
}

$conn->close();

header("Location: dist_teach.php");
exit();
