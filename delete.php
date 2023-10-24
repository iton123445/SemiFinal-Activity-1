<?php
include 'connection.php';


if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    $sql = "DELETE FROM students WHERE student_id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("i", $student_id);
    $result = $stmt->execute();

    if ($result === false) {
        die("Delete failed: " . $stmt->error);
    } else {
        header("Location: view.php");
    }

    $stmt->close();
    $mysqli->close();
} else {
    die("Invalid student ID");
}
?>
