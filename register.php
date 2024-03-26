<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Register on SYSCX</title>
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
                    <td><a href="profile.php">Profile</a></td>
                </tr>
                <tr>
                    <td><a href="register.php">Register</a></td>
                </tr>
                <tr>
                    <td><a href="">Log Out</a></td>
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
         <form  class="form" action="" method="post">
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
                       <label > Program</label>
                       <select name="program" id="program">
                           <option value="">Choose Program</option>
                           <option value="Computer Systems Engineering ">Computer Systems Engineering</option>
                           <option value="Software Engineering">Software Engineering</option>
                           <option value="Communications Engineering">Communications Engineering</option>
                           <option value="Biomedical and Electrical">Biomedical and Electrical</option>
                           <option value="Electrical Engineering">Electrical Engineering</option>
                           <option value="Special">Special</option>
                         </select> <br>
                       <button type="register" name="register">Register</button>  <button type="reset">Reset</button>
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
         //first query to insert inmto user_info 
         $sql = "INSERT INTO users_info VALUES (NULL, '$student_email', '$first_name', '$last_name', '$dob');";

            //excecutes first query 
         if($mysqli->query($sql )){
            //gets the last inserted user_id
            $query2= "SELECT LAST_INSERT_ID() AS student_id";
            $result=$mysqli->query($query2);
            //gets the row 
            $row = $result->fetch_assoc();

            //gets the id from the result fetched 
            $student_Id = $row['student_id'];
         

            //inserts into the other tables through a multi query appproach 
            $query3="INSERT INTO users_program (student_id, Program) VALUES (' $student_Id ', '$program');";
            $query3.="INSERT INTO users_avatar (student_id, avatar) VALUES ('$student_Id ', NULL);";
            $query3.="INSERT INTO users_address (student_id, street_number,street_name,city,province,postal_vcode) VALUES ('$student_Id ', '0',NULL,NULL,NULL,NULL);";
            $mysqli->multi_query($query3);
            // Close the connection
            $mysqli->close();

            // redirect to profile.php
            header("Location: profile.php");
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