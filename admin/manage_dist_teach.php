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
    $season_sql = "SELECT * FROM season WHERE season = $season_id";
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

    // Calculate the duration between exams (in days)
    $exams_duration = 2; // Set the duration between exams (2 days)

    $teachers_sql = "SELECT id FROM teacher";
    $teachers_result = $conn->query($teachers_sql);
    $teachers = array();
    while ($row = $teachers_result->fetch_assoc()) {
        $teachers[] = $row['id'];
    }

    $teacher_count = count($teachers);
    $teacher_index = 0;
    $time = 'first'; 

    foreach ($subjects as  $i => $subject) {
        $sub_id = $subject['id'];
        $time = ($i % 2 == 0) ? 'first' : 'second';
         
        $invigilators = array();
        
        for ($j = 0; $j < 2; $j++) {
            $teacher = $teachers[$teacher_index];
            $invigilators[] = $teacher;

 
            $teacher_index++;
            if ($teacher_index >= $teacher_count) {
                $teacher_index = 0; 
            }
        }


        // Convert the invigilators array to JSON
        $invigilators_json = json_encode($invigilators);

        // Generate a random date within the start and end exams dates, excluding weekends
        $exam_date = generateExamDate($start_exams, $end_exams, $exams_duration);

        // Update the exam record with the selected subject, time, invigilators, and exam date
        $sql = "INSERT INTO exam (sub_id, time, invigilators, exam_date) VALUES ('$sub_id', '$time', '$invigilators_json', '$exam_date')";
        $conn->query($sql);
    }
}

$conn->close();

header("Location: dist_teach.php");
exit();

// Function to generate a random exam date within the given start and end dates, excluding weekends
// Function to generate a random exam date within the given start and end dates, excluding Fridays and Thursdays
function generateExamDate($start_date, $end_date, $duration)
{
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $days_difference = ($end_timestamp - $start_timestamp) / (60 * 60 * 24);

    $valid_exam_dates = array();

    for ($i = 0; $i <= $days_difference - $duration; $i++) {
        $current_date = date("Y-m-d", strtotime("+$i day", $start_timestamp));
        $day_of_week = date("N", strtotime($current_date));

        // Exclude Fridays (5) and Thursdays (4)
        if ($day_of_week != 5 && $day_of_week != 4) {
            $valid_exam_dates[] = $current_date;
        }
    }

    $random_exam_date = $valid_exam_dates[array_rand($valid_exam_dates)]; // Select a random exam date

    return $random_exam_date;
}
