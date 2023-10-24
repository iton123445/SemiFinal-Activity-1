<?php 

	include 'header.php'; 

	include 'connection.php'; 

	$sql = "SELECT * FROM students";

	// Execute the query
	$result = $mysqli->query($sql);

	// Check for query execution success
	if ($result === false) {
	    die("Query failed: " . $mysqli->error);
	}

	?>

	<table id="students">
	  <tr>
	    <th>Student ID</th>
	    <th>Full Name</th>
	    <th>Age</th>
		<th>Action</th>
	  </tr>

	  


  <?php

		// Fetch and display the results
		while ($row = $result->fetch_assoc()) {

		    echo '<tr>';
	    	echo '<td>' . $row["student_id"] . '</td>';
	    	echo '<td>' . $row["first_name"] . ' ' . $row["last_name"] . '</td>';
	    	echo '<td>' . $row["age"] . '</td>';
			echo '<td>
            <a href="update.php?id=' . $row["student_id"] . '">Update</a> 
            <a href="delete.php?id=' . $row["student_id"] . '" onclick="showUpdateLink(); return confirmDelete();">Delete</a>
          </td>';
	    	echo '</tr>';

		}

	?>

	</table>
	
	<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this student?");
}
</script>

	<?php

	// Close the result and connection
	$result->close();
	$mysqli->close();


?>
