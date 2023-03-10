<?php 

$is_invalid = false;

if($_SERVER["REQUEST_METHOD"] === "POST") {      // for collecting data from the form

    $conn = require __DIR__ ."/data.php";

    $sql = sprintf("SELECT * FROM users 
                    WHERE email = '%s'", mysqli_real_escape_string($conn, $_POST["email"])); 
    
    $result = mysqli_query($conn, $sql);   // query to the database

    $user = mysqli_fetch_assoc($result);   // Fetching the result from the database


    if($user){ 

        if (password_verify($_POST["password_1"], $user["password"])){   // $user["password] is the name of the column in database
            
            session_start(); 

            session_regenerate_id();
        

            $_SESSION["user_ID"] = $user["user_ID"];

            header("Location: public/profile.html"); 
            exit;
        }
    }
    $is_invalid = true;

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles-login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js" defer></script>
    <script src="ajax/validation-login.js" defer></script>
</head>
<body>
<h1 class="header">Login Page</h1> 

<div id="signup">
<form method="post">
       <div class="row mb-3">
        <label for="email" class="col-sm-2 col-form-label">Email ID<br></label><br> 
        <div class="col-sm-4">
        <input type="email" name = "email" id="email"><br>
        </div>
        </div>
        <div class="row mb-3">
        <label for="password"  class="col-sm-2 col-form-label">Password<br></label><br>
        <div class="col-sm-4">
        <input type="password" name = "password_1" id="password_1"><br>
        </div> 
        </div>
        <div>
        <p class="form-message"></p>
        </div>
        <div class="col-sm-4" >
        <label for="submit"><button type = "submit" id="submit" onclick="addData()">Log In</button></label>
        </div>
    
        <div>
        <p>Not Registered yet? <a href="signup.html">Sign Up</a></p>
        </div>
    </form>
    
</div>

</body>
</html>