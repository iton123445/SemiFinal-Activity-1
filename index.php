
<?php 

	include 'header.php'; 

	include 'connection.php'; 

	if(isset($_POST['submit'])) {

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$age = $_POST['age'];

		$sql = "INSERT INTO students (first_name, last_name, age) VALUES (?, ?, ?)";

	    // Create a prepared statement
	    $stmt = $mysqli->prepare($sql);

	    if ($stmt) {
	        // Bind the parameters and execute the query
	        $stmt->bind_param('ssi', $first_name, $last_name, $age);

	        if ($stmt->execute()) {
	            echo "Student record inserted successfully.";
	        } else {
	            echo "Error: " . $stmt->error;
	        }

	        // Close the prepared statement
	        $stmt->close();
	    } else {
	        echo "Error: " . $mysqli->error;
	    }

	    // Close the database connection
	    $mysqli->close();

	}


?>




<h1>Student Registration</h1>


<form action="index.php" method="post">
	<p>First Name: <input type="text" name="first_name" placeholder="Enter your first name"></p>
	<p>Last Name: <input type="text" name="last_name" placeholder="Enter your last name"></p>
	<p>Age: <input type="number" name="age"></p>
	<input type="submit" name="submit" value="Register">
</form>

