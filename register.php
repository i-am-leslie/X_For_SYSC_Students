<?php
    // Start the session
    session_start();

    // Remove all session variables
    session_unset();

    // Destroy the session
    session_destroy();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Register on SYSCX</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/main.css">
   <script src="assets/js/register.js"></script>
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
                <!-- <tr>
                    <td><a href="profile.php">Profile</a></td>
                </tr>  -->
                <tr>
                    <td><a href="register.php">Register</a></td>
                </tr>
                <tr>
                    <td><a href="login.php">Log in</a></td>
                </tr>
            </tbody>
        </table>
      </div>
   </nav>
   <main>
      <section>
         <h2>Register a new profile</h2>
         <form>
            <fieldset>
               <legend><span>Personal information</span></legend>
            </fieldset>
         </form>

         <!--This is the section for the form to be submitted -->
         <form id="form" class="form" action="" method="post">
            <table>
               <tr>
                   <td> <p><label >First name</label> <input type="text" name="first_name" > </p></td>
                   <td><label >Last name</label> <input type="text" name="last_name"></td>
                   <td><label >DOB</label> <input type="date" name="DOB" ></td>
               </tr>
               <tr class="profile">
                   <td colspan="3" >Profile Information</td>
               </tr>
               <tr>
                   <td colspan="3"><label >Email addess</label><input type="email" name="student_email">  <br> 
                       <label > Program:</label>
                       <select name="program" id="program">
                           <option value="">Choose Program</option>
                           <option value="Computer Systems Engineering">Computer Systems Engineering</option>
                           <option value="Software Engineering">Software Engineering</option>
                           <option value="Communications Engineering">Communications Engineering</option>
                           <option value="Biomedical and Electrical">Biomedical and Electrical</option>
                           <option value="Electrical Engineering">Electrical Engineering</option>
                           <option value="Special">Special</option>
                         </select> <br>
                         <label >Password</label><input id="password" type="password" name="password"> 
                         <label >Confirm Password</label><input id="confirmpassword" type="password" name="confirm_password"> <br>
                       <button id="submit"type="register" name="register">Register</button>  <button type="reset">Reset</button>
                   </td>
               </tr>
           </table>
         </form>
      </section>
   </main>

<!-- This is the div section for the second nav beside the page -->
   <div class="nav2">
         
   </div>
</div>
<?php
   // connects to the database 
   require "connection.php";
   $mysqli = new mysqli($server_name, $username, $password, $database_name);
  

   try{
      if(isset($_POST["register"])){
         $first_name=$_POST["first_name"];
         $last_name=$_POST["last_name"];
         $dob=$_POST["DOB"];
         $student_email=$_POST["student_email"];
         $program=$_POST["program"];
         $password=$_POST["password"];
         $hash_password= password_hash($password, PASSWORD_BCRYPT);


         //check if the mail already exists after registering  to inform
         $checkemail="SELECT * FROM `users_info` WHERE student_email=?";
         $st=$mysqli->prepare($checkemail);
         $st->bind_param("s", $student_email);
         $st->execute();
         $result = $st->get_result(); 
         // condition to check if the email exists 
         if(mysqli_num_rows($result)>0){
            echo "This email has already been registered";
            echo"<h3>Please change the email</h3>";
         }else{
            //first query to insert inmto user_info
            $sql = "INSERT INTO users_info  (student_email, first_name, last_name, dob) VALUES ( ?, ?, ?, ?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssss", $student_email, $first_name,$last_name,$dob );

               //excecutes first query 
            if($stmt->execute()){
               //gets the last inserted user_id
               $query2= "SELECT LAST_INSERT_ID() AS student_id";
               $stmt = $mysqli->prepare($query2);
               $stmt->execute();
               //gets the row 
               $result = $stmt->get_result();
               $row = $result->fetch_assoc();
               //gets the id from the result fetched 
               $student_id = $row['student_id'];

               $stmt->close();
            
               
      
            

               //inserts into the other tables through a multi query appproach 
               $query3="INSERT INTO users_program (student_id, Program) VALUES (?, ?);";
               $query4="INSERT INTO users_avatar (student_id, avatar) VALUES (? , NULL);";
               $query5="INSERT INTO users_address (student_id, street_number,street_name,city,province,postal_vcode) VALUES (? , '0',NULL,NULL,NULL,NULL);";
               $query6="INSERT INTO users_passwords (student_id, password) VALUES (? , ?);";
               $query7="INSERT INTO users_permissions (student_id, account_type) VALUES (? , 1);";
            
               // Query to insert into users_program table 
               $stmt1 = $mysqli->prepare($query3);
               $stmt1->bind_param("is", $student_id, $program);
               $stmt1->execute();

               // Query to insert into users_avatar table 
               $stmt2 = $mysqli->prepare($query4);
               $stmt2->bind_param("i", $student_id);
               $stmt2->execute();

               // Query to insert into users_address table 
               $stmt3 = $mysqli->prepare($query5);
               $stmt3->bind_param("i", $student_id);
               $stmt3->execute();

               // Query to insert into users_password table 
               $stmt4 = $mysqli->prepare($query6);
               $stmt4->bind_param("is", $student_id,$hash_password);
               $stmt4->execute();

               // Query to insert into users_permissions table 
               $stmt5 = $mysqli->prepare($query7);
               $stmt5->bind_param("i", $student_id);
               $stmt5->execute();

         }
            // Close the connection
            $mysqli->close();

            // redirect to profile.php
            header("Location: login.php");
            exit();
         }
      }

   }catch(mysqli_sql_exception $e){
      // catches any error that results from the database 
       echo $e->getMessage();
   }
   
?>

</body>

</html>