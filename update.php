

<?php
include 'header.php';

include 'connection.php';

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];

        $sql = "UPDATE students SET first_name=?, last_name=?, age=? WHERE student_id=?";

        $stmt = $mysqli->prepare($sql);

        if ($stmt) {

            $stmt->bind_param('ssii', $first_name, $last_name, $age, $student_id);

            if ($stmt->execute()) {
                echo "Student record updated successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $mysqli->error;
        }

        header("Location: view.php");
        exit();
    }

    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $mysqli->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param('i', $student_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        
        $stmt->close();
    }

    if (empty($student)) {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Student ID not provided.";
    exit();
}
?>

<h1>Edit Student Record</h1>

<form action="update.php?id=<?= $student_id ?>" method="post">
    <p>First Name: <input type="text" name="first_name" value="<?= $student['first_name'] ?>"></p>
    <p>Last Name: <input type="text" name="last_name" value="<?= $student['last_name'] ?>"></p>
    <p>Age: <input type="number" name="age" value="<?= $student['age'] ?>"></p>
    <input type="submit" name="submit" value="Update">
</form>

<?php
$mysqli->close();
?>
