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
                  <td><p><textarea name="new_post"  cols="50" rows="5"></textarea> <br>
                     <button type="submit" name="post">Post</button> <button type="reset">Reset</button></p></td>
               </tr>
               
               
            </tbody>
            
         </table>
      </form>

      <!-- This is the section for the post created -->
      <?php
    require "connection.php";
    $mysqli = new mysqli($server_name, $username, $password, $database_name);
    try{
       if(isset($_POST["post"])){
          $new_post=$_POST["new_post"];
         
 
          //query to get the last added user 
          $query2= "SELECT MAX(student_id) AS student_id FROM users_info";
          $result=$mysqli->query($query2);
          $row = $result->fetch_assoc();
          $student_id = $row['student_id'];
      
         //Query insert the post 
          $sql = "INSERT INTO users_posts VALUES (NULL, '$student_id','$new_post', NOW() );";
 
          
          if ($mysqli->query($sql)) {
            echo "Posted successfully.<br>"; 
        
            $sql = "SELECT * FROM users_posts WHERE student_id = '$student_id' ORDER BY post_date DESC LIMIT 5";
            $result2 = $mysqli->query($sql); 
        
            echo "<div id='posts_section'>";
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    echo "<details open>
                            <summary>Post " . $row["post_id"] . "</summary>
                            <p>" . $row["new_post"] . "</p>
                          </details>";
                }
            }
            echo "</div>";
        }
        
         
 
        
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
            <tr><td><p>First Last Name</p></td></tr>
            <tr><td><p><img src="images/img_avatar2.png" alt="profile image"></p> </td></tr>
            <tr><td><p>Email: <a href="">student@cmail.carleton</a></p></td></tr>
            <tr><td><p>Program: <br> Computer <br> Systems <br> Engineering  </p></td></tr>
         </tbody>
      </table>    
   </div>
   </div>
</div>
</body>
</html>