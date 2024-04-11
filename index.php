<?php
   
	//Start a new session
	session_start();

   if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      // User is not logged in, redirect to login page
      header('Location: login.php');
      exit; // Ensure script execution ends here
   }
	//Set the session duration for 3 minutes
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
   <title>SYSC - Main</title>
   <link rel="stylesheet" href="assets/css/reset.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
   <header>
      <h1>SYSCX</h1>
      <p>Social media for SYSC students in Carleton University</p>
   </header>
   <div>
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
                    <td><a href="logout.php">Log Out</a></td>
                </tr>
                <tr>
                    <td><a  id="users_list"href="users_list.php"></a></td>
                </tr>
            </tbody>
        </table>
      </div>
   </nav>
   <main>
      <div>
         <form>
            <fieldset>
               <legend>
                  <span>NEW POST</span>
               </legend>
            </fieldset>
         </form>
      </div>
      <form class="text" action="" method="post">
         <table>
            <tbody>
               <tr>
                  <td><p><textarea name="new_post"  cols="50" rows="5"> </textarea> <br>
                     <button id="post" type="submit" name="post">Post</button> <button type="reset">Reset</button></p></td>
               </tr>
               
               
            </tbody>
            
         </table>
      </form>
      <?php
      //Check the session is expired or not
      if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > $expiryTime)) {
         //Unset the session variables
         session_unset();
         //Destroy the session
         session_destroy();
         echo "Session is expired.<br/>";
         header("Location: login.php");
      } else if (isset($_SESSION['StudentNumber'])){
         echo "<p><strong>Studnet Number is: </strong>" .$_SESSION["StudentNumber"]. "</p>";
      }
      ?>



      <!-- This is the section for the post created -->
      <?php
    require "connection.php";
    $mysqli = new mysqli($server_name, $username, $password, $database_name);
    if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
  }

  try {
   
      if (isset($_POST["post"]) && isset($_SESSION['StudentNumber']) ) {
          $new_post = $_POST["new_post"];
  
          // Gets the studnet number from session 
          $student_id = $_SESSION["StudentNumber"];

         
  
          // Query to insert the post
          $sql = "INSERT INTO users_posts (student_id, new_post, post_date) VALUES (?, ?, NOW())";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param("is", $student_id, $new_post);
          if ($stmt->execute()) {
              echo "Posted successfully.<br>";
  
              // Query to select recent posts
              $sql = "SELECT * FROM users_posts WHERE student_id = ? ORDER BY post_date DESC LIMIT 5";
              $stmt2 = $mysqli->prepare($sql);
              $stmt2->bind_param("i", $student_id);
              $stmt2->execute();
              $result2 = $stmt2->get_result();
  
              echo "<div id='posts_section'>";
              while ($row = $result2->fetch_assoc()) {
                  echo "<details open>
                          <summary>Post " . $row["post_id"] . "</summary>
                          <p>" . $row["new_post"] . "</p>
                        </details>";
              }
              echo "</div>";
            


  
              $stmt2->close();
          }
          $stmt->close();
      }else if (!isset($_SESSION['StudentNumber'])){
         header("location:login.php");
      }
  
      // Close the connection
      $mysqli->close();
    }catch(mysqli_sql_exception $e){
       // catches any error that results from the database 
        echo $e->getMessage();
    }

?>
      
   </main>
   <!-- This is the div section for the second nav beside the page -->
   <div class="nav2">
      <table>
         <tbody>
            <tr><td id="first_last"> </td></tr>
            <tr><td><p ><img id="profile_pic" src="images/img_avatar2.png" alt="profile image"></p> </td></tr>
            <tr><td id="student_email"></a></p></td></tr>
            <tr><td id="program_input"></td></tr>
         </tbody>
      </table>    
   </div>
</div>
</body>
               <script type='text/javascript'>
						// const inputControl = document.querySelectorAll("input, select");
						console.log("<?php echo $_SESSION['permission']; ?>");
                  const permission=  "<?php echo $_SESSION['permission']; ?>";
						if (permission=="0"){
                     const users_list=document.querySelector("#users_list");
                     users_list.textContent="Users List";
                  }
                  // Listen for changes on any radio button with the name 'avatar'
                  
                  const changeAvatar = "images/img_avatar" + (Number("<?php echo $_SESSION['avatar']; ?>") + 1) + ".png";
                  console.log(changeAvatar);
                  document.querySelector("#profile_pic").src=changeAvatar;


                  let  first_last=document.querySelector("#first_last");

                  // For first and last name 
                  const text=document.createTextNode("<?php echo $_SESSION['first_name']; ?>"+" " + "<?php echo $_SESSION['last_name']; ?>");
                  const p = document.createElement("p");
                  p.appendChild(text);
                  first_last.appendChild(p);
                  console.log(first_last);

                  let emailplacement= document.querySelector("#student_email");

                   // email
                  const text1=document.createTextNode("Email:" + " "+ "<?php echo $_SESSION['email']; ?>");
                  const p1 = document.createElement("p");
                  p1.appendChild(text1);
                  emailplacement.appendChild(p1);
                  console.log(text1);

                  let programinput=document.querySelector("#program_input");

                  const text2=document.createTextNode("Program:" +" " + "<?php echo $_SESSION['Program']; ?>");
                  const p2 = document.createElement("p");
                  p2.appendChild(text2);
                  programinput.appendChild(p2);
                  console.log(text2);

                  
            	</script>
</html>