<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
session_start();
     if(!isset($_SESSION["uid"])){
      session_unset();
      session_destroy();
      header("Cache-Control:no-store,no-cache,must-revalidate, max-age=0");
      header("Cache-Control:post-check=0, pre-check=0",false);
     header("Pragma: no-cache");
      header('Location: login.php');
      exit();
     }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration-Form</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="validation.js" defer></script>
  <style>
    
    .header {
        background-color: transperent;
        padding: 2px 250px;
        width:100%;
        
        display: flex;
        justify-content: flex-end;
    }
    .header a {
        text-decoration: none;
        color: black;
        margin-left: 20px;
        font-size:24px;
        font-weight: bold;
    }
    .header a:hover {
        text-decoration: none;
    }
    h1{
      color:black;
    }
</style>
</head>
  
<header class="header">
        <a href="STFS.php">Signup</a>
        <a href="login.php">Login</a>
        <a href="editProfile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </header>
    <!-- Main content goes here -->
<body><div class="wrapper">
     <form id="form" method="POST">
<button type="submit" onclick="Logout()">Logout</button>
</form>
  </div>
<script>
function Logout(){

history.replaceState(null,'',location.href);
history.pushState(null, '', 'about:blank');
}
</script>
</body>
</html>
