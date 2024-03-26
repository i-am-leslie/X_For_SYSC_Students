<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>Update SYSCX profile</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/main.css">
   <script src="assets/js/updateField.js"></script>
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
         <h2>Update Profile information</h2>
         <form>
            <fieldset>
               <legend><span>Personal information</span></legend>
            </fieldset>
         </form>

          <!--This is the section for the form to be submitted -->
         <form  class="form" action="#" method="post">
            <table>
               <tr>
                   <td><label >First name</label> <input id="first_name" type="text" name="first_name"></td>
                   <td><label >Last name</label> <input id="last_name" type="text" name="last_name" ></td>
                   <td><label>DOB</label> <input id="date" type="date" name="DOB" ></td>
               </tr>
               <tr class="profile">
                   <td colspan="3" >Address</td>
               </tr>
               <tr>
                   <td><label >Street Number: <input  id="street_number" type="number" name="street_number"></label></td>
                   <td colspan="2"> <label>Street Name: <input  id="street_name" type="text" name="street_name"></label></td>
               </tr>
               <tr>
                  <td><label >City: <input  id="city" type="text" name="city"></label></td>
                  <td><label >Province: <input  id="province" type="text" name="province"></label></td>
                  <td><label >Postal Code: <input  id="postal_code" type="text" name="postal_code"></label></td>
               </tr>
               <tr class="profile">
                  <td colspan="3" >Profile Information</td>
              </tr>
              <tr>
                  <td colspan="3"> <label >Email address <input  id="email" type="email" name="student_email"></label></td>
              </tr>
              <tr>
               <td colspan="3"><label > Program</label>
                  <select name="program" id="program">
                     <option value="">Choose Program</option>
                     <option value="Computer Systems Engineering">Computer Systems Engineering</option>
                     <option value="Software Engineering">Software Engineering</option>
                     <option value="Communications Engineering">Communications Engineering</option>
                     <option value="Biomedical and Electrical">Biomedical and Electrical</option>
                     <option value="Electrical Engineering">Electrical Engineering</option>
                     <option value="Special">Special</option>
                  </select>
               </td>
              </tr >
              <tr >
                  <td colspan="3">
                     <p>Choose your Avatar</p><br> 
                     <div id="avatar">
                        <label>
                           <input type="radio" name="avatar" value="0">
                           <img src="images/img_avatar1.png" alt="Avatar 1">
                       </label>
                       <label>
                           <input type="radio" name="avatar" value="1">
                           <img src="images/img_avatar2.png" alt="Avatar 2">
                       </label>
                       <label>
                           <input type="radio" name="avatar" value="2">
                           <img src="images/img_avatar3.png" alt="Avatar 3">
                       </label>
                       <label>
                           <input type="radio" name="avatar" value="3">
                           <img src="images/img_avatar4.png" alt="Avatar 4">
                       </label>
                       <label>
                           <input type="radio" name="avatar" value="4">
                           <img src="images/img_avatar5.png" alt="Avatar 5">
                       </label>
                     </div>

                  </td>
              </tr>
           </table>
           <button type="submit" name="submit">submit</button>  <button type="reset">Reset</button>
         </form>
      </section>
   </main>

   <!-- This is the div section for the second nav beside the page -->
   <div class="nav2">
      <table>
         <tbody>
            <tr><td><p>First Last Name</p></td></tr>
            <tr><td><p><img src="images/img_avatar2.png" alt="profile image"></p> </td></tr>
            <tr><td><p>Email: <a href="">student@cmail.carleton</a></p></td></tr>
            <tr><td><p>Program: <br> Computer <br> Systems <br> Engineering  </p></td></tr>
         </tbody>
      </table>    
   </div>
</div>
</body>
<?php
  

  
   require "connection.php";
   $mysqli = new mysqli($server_name, $username, $password, $database_name);
   try{
      if(isset($_POST["submit"])){
         $first_name=$_POST["first_name"];
         $last_name=$_POST["last_name"];
         $dob=$_POST["DOB"];
         $street_number=$_POST["street_number"];
         $street_name=$_POST["street_name"];
         $city=$_POST["city"];
         $province=$_POST["province"];
         $postal_vcode=$_POST["postal_code"];
         $email=$_POST["student_email"];
         $program=$_POST["program"];
         $avatar=$_POST["avatar"];

         //query to get the last added user 
         $query2= "SELECT MAX(student_id) AS student_id FROM users_info";
         $result=$mysqli->query($query2);
         $row = $result->fetch_assoc();
         $student_id = $row['student_id'];

         //query to update users info 
         $sql = "UPDATE users_info SET first_name='$first_name', last_name='$last_name', dob='$dob', student_email='$email' WHERE student_id='$student_id';";

            
         if($mysqli->query($sql )){
            
            //inserts into the other tables through a multi query appproach 
            $sql2 = "UPDATE users_avatar SET avatar='$avatar' WHERE student_id='$student_id';";
            $sql2 .= "UPDATE users_address SET street_number='$street_number', street_name='$street_name', city='$city', province='$province', postal_vcode='$postal_vcode' WHERE student_id='$student_id';";
            $sql2 .= "UPDATE users_program SET Program='$program' WHERE student_id='$student_id';";
            $mysqli->multi_query($sql2);
         }
 
      }else{
         //Query to get the most recent id
         $query2= "SELECT MAX(student_id) AS student_id FROM users_info";
         $result=$mysqli->query($query2);
         $row = $result->fetch_assoc();
         $student_id = $row['student_id'];
        
         //gets all the neccessary information from the user_info database table to update the fields in the DOM
         $sql = "SELECT first_name, last_name, dob,student_email FROM users_info WHERE student_id='$student_id';";
         $result2=$mysqli->query($sql);
         $row = $result2->fetch_assoc();
         $first_name = $row['first_name'];
         $last_name = $row['last_name'];
         $dob = $row['dob'];
         $email=$row['student_email'];
         

         //gets all the neccessary information from the user_address database table to update the fields in the DOM
         $sql2 = "SELECT street_number, street_name, city,province, postal_vcode FROM users_address WHERE student_id='$student_id';";
         $user_address=$mysqli->query($sql2);
         $row = $user_address->fetch_assoc();
         $street_number = $row['street_number'];
         $street_name = $row['street_name'];
         $city = $row['city'];
         $province = $row['province'];
         $postal_vcode = $row['postal_vcode'];
   


         //gets all the neccessary information from the user_progranm database tableto update the fields in the DOM 
         $sql3 = "SELECT Program FROM  users_program WHERE student_id='$student_id';";
         $programs=$mysqli->query($sql3);
         $row = $user_address->fetch_assoc();
         $program = $row['Program'];


         //gets all the neccessary information from the user_avatar database to update the fields in the DOM
         $sql4 = "SELECT avatar FROM users_avatar WHERE student_id='$student_id';";
         $avartars=$mysqli->query($sql4);
         $row = $avartars->fetch_assoc();
         $avatar = $row['avatar'];
      }

      // Close the connection
      $mysqli->close();

   }catch(mysqli_sql_exception $e){
      // catches any error that results from the database 
       echo $e->getMessage();
   }
   //script to uodate the DOM by using javascript to manipulate the DOM
   echo "<script>
   document.addEventListener('DOMContentLoaded', function(e) {
       let firstName = document.querySelector('#first_name');
       let lastName = document.querySelector('#last_name');
       let dob = document.querySelector('#date');
       let email = document.querySelector('#email');

       firstName.value = '" . $first_name . "'; // Output PHP variable value into JavaScript
       lastName.value = '" . $last_name . "'; // Output PHP variable value into JavaScript
       dob.value = '" . $dob . "'; // Output PHP variable value into JavaScript
       email.value='" . $email . "';


       let streetNumber = document.querySelector('#street_number');
       let streetName = document.querySelector('#street_name');
       let city = document.querySelector('#city');
       let province = document.querySelector('#province');
       let postalcode = document.querySelector('#postal_code');

       streetNumber.value = '" .  $street_number . "'; // Output PHP variable value into JavaScript
       streetName.value = '" . $street_name  . "'; // Output PHP variable value into JavaScript
       city.value='" . $city . "'; 
       province.value='" . $province . "'; 
       postalcode.value='" . $postal_vcode . "'; 

       let program = document.querySelector('#program');
       program.value=  '" . $program . "'; 

       var radios = document.querySelectorAll(\"input[name='avatar']\");

								radios.forEach(radio => {
									if (radio.value === '$avatar') {
										radio.checked = true;
									}
								});


      });
   </script>";


?>
</html>