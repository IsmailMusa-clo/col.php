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

// Fetch all subjects from exam table
$sql = "SELECT id, name FROM subjects";
$result = mysqli_query($conn, $sql);
$subjects = array();
while ($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

foreach ($subjects as $subject) {
    $sub_id = $subject['id'];

    // Check if the subject already has assigned invigilators and time
    $sql = "SELECT * FROM exam WHERE sub_id = $sub_id AND invigilators IS NOT NULL AND time IS NOT NULL";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Select teachers who do not teach the subject
        $sql = "SELECT teacher.id FROM teacher LEFT JOIN teach_subject ON teacher.id = teach_subject.tech_id AND teach_subject.sub_id = $sub_id WHERE teach_subject.id IS NULL";
        $result = $conn->query($sql);
        $teachers = array();
        while ($row = $result->fetch_assoc()) {
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

        // Update the exam record with the selected subject, time, and invigilators
        $sql = "UPDATE exam SET time = '$time', invigilators = '$invigilators_json' WHERE sub_id = $sub_id";
        $conn->query($sql);
    }
}

$conn->close();

header("Location: dist_teach.php");
exit();
