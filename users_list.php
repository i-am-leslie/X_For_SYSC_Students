<?php
   
	//Start a new session
	session_start();


   if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      // User is not logged in, redirect to login page
      header('Location: login.php');
      exit; // Ensure script execution ends here
  }
	//Set the session duration for 5 seconds
	$expiryTime = 180;
	//Check the session start time is set or not
	if(!isset($_SESSION['start'])){
		//Set the session start time
    	$_SESSION['start'] = time();
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users list</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<header>
      <h1>SYSCX</h1>
      <P>LIST OF USERS </P>
   </header>
   
<?php
   require "connection.php";
   $mysqli = new mysqli($server_name, $username, $password, $database_name);

    try{
        // Retrieve and display information from the database
        $retrieve_query = "SELECT users_info.student_id, users_info.first_name, users_info.last_name, users_info.student_email, users_program.Program, users_permissions.account_type FROM users_info INNER JOIN users_program ON users_info.student_id = users_program.student_id INNER JOIN users_permissions ON users_info.student_id = users_permissions.student_id";

        $retrieve_query2 = "SELECT * FROM users_permissions " ;

        $result = $mysqli->query($retrieve_query);
        $result2 = $mysqli->query($retrieve_query2);
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th> Student ID</th>";
            echo "<th> First Name</th>";
            echo "<th>  Last Name</th>";
            echo "<th>  Student Email</th>";
            echo "<th> Program </th>";
            echo "<th> Account Type </th>";
            echo "</tr>";
            while ($row = $result->fetch_assoc() ) {
                echo "<tr> <td>" . $row['student_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['student_email'] . "</td>";
                echo "<td>" . $row['Program'] . "</td> ";
                echo "<td>" . $row['account_type'] . "</td> </tr>";
            }
            echo "</table>";
        } else {
            echo "No registered user.";
        }
    
        // Close the connection
        $mysqli->close();



    }catch(mysqli_sql_exception $e){
        echo $e->getMessage();

    }


    
?>
    
</body>
</html>