<?php
 // Include the function to read CSV

 $filename = "/var/www/html/data.csv";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  function readCSV($filename) {
      $rows = [];
      if (($handle = fopen($filename, 'r')) !== false) {
          while (($data = fgetcsv($handle)) !== false) {
              $rows[] = $data;
          }
          fclose($handle);
      }
      return $rows;
  }
  

    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $newPassword = $_POST['Password']; // Assume it's already sanitized
//    $email =  hash('md5' , $email);
    $newPassword= hash('md5', $newPassword);
    // Read the CSV file
    $rows = readCSV($filename);

    $updated = false;
    $updatedRows = [];

    // Process each row to find the user
    foreach ($rows as $index => $row) {
        if ($row[3] === $email) {
            // Update the password
           // $row[4] = password_hash($newPassword, PASSWORD_DEFAULT); for hashing
            $row[4] = $newPassword;
            $row[5] = $newPassword;
            $updated = true;
        }
        $updatedRows[] = $row;
    }

    if ($updated) {
        // Write updated data back to CSV
        
        if (($handle = fopen($filename, 'w')) !== false) {
            foreach ($updatedRows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
            ?> <script> alert("Password updated successfully."); </script> <?php
        } else {
          ?> <script> alert( "Error opening the file for writing."); </script> <?php
        }
    } else {
      ?> <script> alert( "User not found."); </script> <?php
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ResetPassword.com</title>
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
<body>
<header class="header">
        <a href="STFS.php">Signup</a>
        <a href="login.php">Login</a>
        <a href="editProfile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </header>
  <div class="wrapper">
    <h1>Reset Password</h1>
    <p id="error-message"></p>
    <form id="form" method="POST">
    <div>
    <label for="email-input">
          <span>@</span>
        </label>
	     <input type="text" name="Email" id="email-input"      placeholder="Email">
      </div>
      <div>
      <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
	     <input type="text" name="Password" id="pass-input"      placeholder="Password">
      </div>
      
    <div>
    <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
	    <input type="text" name="repeat-password" id="pass-input" placeholder="confrim password">
	</div>
    <button type="submit">Confirm</button>
</form>
<p>Back to login <a href="login.php">login</a> </p>

</div>
</body>
</html>
