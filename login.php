<?php
	//Start a new session
	session_start();
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
   <meta charset="utf-8">
   <title>Log in to  SYSCX</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
   <header>
      <h1>SYSCX</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <div class="content">
   <nav>
      <div class="nav">
         <table>
            <tbody>
                <tr>
                    <td><a href="index.php">Home</a></td>
                </tr>
                <tr>
                    <td><a href="register.php">Register</a></td>
                </tr>
                <tr>
                    <td><a href="">Log in</a></td>
                </tr>
            </tbody>
        </table>
      </div>
   </nav>
   <main>
      <section>
         <h2>Login in existing user</h2>
         <form>
            <fieldset>
               <legend><span></span></legend>
            </fieldset>
         </form>

         <!--This is the section for the form to be submitted -->
         <form id="form" class="form" action="" method="post">
            <table>
               <tr>
                <p>Email <input name="student_email" type="email"></p>
                <p>Password <input name="password" type="password"></p>
               </tr>
               <tr><button name="login"> Login</button>  <button  type="reset">Reset</button></tr>
               <tr><p>Dont have an account ?  <button><a href="register.php">Register</a></button></p></tr>
           </table>
         </form>
      </section>
   </main>

<!-- This is the div section for the second nav beside the page -->
   <div class="nav2">
         
   </div>
</div>
<?php
      //Check the session is expired or not
      if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > $expiryTime)) {
         //Unset the session variables
         session_unset();
         //Destroy the session
         session_destroy();
         echo "Session is expired.<br/>";
      } else if (isset($_SESSION['StudentNumber'])){
         echo "<p>Current session exists.</p>";
         echo "<p><strong>Student Number is: </strong>" .$_SESSION["StudentNumber"]. "</p>";
      }
      ?>
<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
   // connects to the database 
   require "connection.php";
   $mysqli = new mysqli($server_name, $username, $password, $database_name);
  

   try{

    if(isset($_POST["login"])){
        $student_email=$_POST["student_email"];
        $password=$_POST["password"];


         //check if the mail already exists after registering  to inform
        $checkemail="SELECT student_id FROM `users_info` WHERE student_email=?";
        $stmt=$mysqli->prepare($checkemail);
        $stmt->bind_param("s", $student_email);
        $stmt->execute();
        $result = $stmt->get_result(); 
        $row=$result->fetch_assoc();
        $student_id = $row['student_id'];

        //gets all the neccessary information from the user_info database table to update the fields in the DOM
        $sql = "SELECT first_name, last_name, dob, student_email FROM users_info WHERE student_id = ?";
        $stmt1 = $mysqli->prepare($sql);
        $stmt1->bind_param("i", $student_id);
        $stmt1->execute();
        $result2 = $stmt1->get_result();
        $row = $result2->fetch_assoc();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['student_email'];
        $_SESSION["first_name"]=$first_name;
        $_SESSION["last_name"]=$last_name;
        $_SESSION["email"]=$email;

        //gets all the neccessary information from the user_info database table to update the fields in the DOM
        $sql2 = "SELECT Program FROM users_program WHERE student_id = ?";
        $stm = $mysqli->prepare($sql2);
        $stm->bind_param("i", $student_id);
        $stm->execute();
        $result3 = $stm->get_result();
        $ro = $result3->fetch_assoc();
        $program = $ro['Program'];
        $_SESSION["Program"]=$program;


        

         // condition to check if the email exists 
         if($row){
            $checkpassword="SELECT password FROM `users_passwords` WHERE student_id=?";
            $st=$mysqli->prepare($checkpassword);
            $st->bind_param("i", $student_id);
            $st->execute();
            $result2 = $st->get_result(); 
            $row2=$result2->fetch_assoc();
            $hash_password= $row2['password'];

            //get the permission of the user 
            $checkpermission="SELECT account_type FROM `users_permissions` WHERE student_id=?";
            $st1=$mysqli->prepare($checkpermission);
            $st1->bind_param("i", $student_id);
            $st1->execute();
            $result3 = $st1->get_result(); 
            $row3=$result3->fetch_assoc();
            $permission= $row3['account_type'];

            // gets the users avatar picture to store in the session 
           
            $profile="SELECT avatar FROM `users_avatar` WHERE student_id=?";
            $st2=$mysqli->prepare($profile);
            $st2->bind_param("i", $student_id);
            $st2->execute();
            $result4 = $st2->get_result(); 
            $row4=$result4->fetch_assoc();
            $profilepic= $row4['avatar'];

            echo "Checking password...";
            if(password_verify($password, $hash_password)){
                echo "Password verified successfully.";
                //puts the student id on session global 
                $_SESSION["StudentNumber"] = $student_id;
                $_SESSION['loggedin'] = true;
                $_SESSION['permission'] = $permission;
                $_SESSION['avatar'] = $profilepic;
                $stmt->close();
                $st->close();  
                $st1->close();  
                header("location:index.php");
                exit();

            }else {
                echo "Password verification failed.";  // If password_verify fails
            }
           
         }else{
            echo "You do not have an account please regsiter ";
         }
            // Close the connection
            $mysqli->close();
            exit();
         }
      }
   catch(mysqli_sql_exception $e){
      // catches any error that results from the database 
       echo $e->getMessage();
   }
   
?>


</body>

</html>