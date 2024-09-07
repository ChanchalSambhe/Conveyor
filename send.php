<?php
 $randomInt=0;

     $randomInt = rand(1,10000);
//echo "Random Integer: " . $randomInt . "<br>";
  
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //echo"chanchal sambhe";
    // include("dbconnection.php");  use when database connection file is different 
    
    $key = $_POST["key"];
    $hash = $_POST["otp"];

// Stored hash from the database
   $stored_hash = $hash; // Example hash

// Password input to verify
    $password_input =sha1($key);
    $n = 5; // Number of characters to extract from the end
    $password_input = substr($password_input, -$n);
// Verify the password against the stored hash
if ($password_input === $stored_hash) {
    header("location:link.php");
} else {
    ?> <script> alert("Icorrect Token!!");</script> <?php
}

   // $em= $_POST["Email"];
    //$to = '$em';
    //$subject = 'To change the password';
        
    // $message = "Update your password by clicking on the link here" a href="Index.php">login</a> </p>" <?php
   //  
      //   mail($em, $subject, $message);

      //   if(mail()){
      //  "link is send !!! ");</script> <?php
      //   }
      //   else{
      // "somethins wents wrong!!!");</script> <?php
      //   }


//$filePath = "C:/xampp/htdocs/data.csv"; // Path to your CSV file

// Define the path to the CSV file
//$csvFile = "C:/xampp/htdocs/data.csv"; 

// Check if the file exists
// if (!file_exists($csvFile)) {
//     die('File not found');
// }

// Initialize an array to hold user data
//$users = [];

// // Open the CSV file for reading
// if (($handle = fopen($csvFile, 'r')) !== FALSE) {
//     // Read the header row
//     $header = fgetcsv($handle);
    
//     // Read each line of the CSV file
//     while (($data = fgetcsv($handle)) !== FALSE) {
//         // Map CSV data to associative array
//         $users[] = [
//             'Email'    => $data[3],
//         ];
//     }
//     fclose($handle);
// } else {
//     die('Failed to open the file');
// }

// // Get the user input from the POST request
// $userEmail = isset($_POST['Email']) ? trim($_POST['Email']) : '';

// // Sanitize user input
// $userEmail = htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8');

// // Flag to check if user credentials are valid
// //$isValid = false;

// // Check if the user input matches any record in the CSV data
// foreach ($users as $user) {
 
//     if ($user['Email'] === $userEmail ) {
//       header("location:link.php");
//     //  mail($to, $subject, $message);

//     //  if(mail()){
//      //  ("link is send !!! ");</script> <?php
//       //}
//       //else{
//     //<script> alert ("somethins wents wrong!!!");</script> <?php
//     //  }
//     } else {
//       "Invalid email or password."); </script> <?php
//     }
// }

// // Output the result
// // if ($isValid) {
// //     "Login successful!"); </script> <?php
// // } else {
// //    "Invalid email or password."); </script> <?php
// // }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ForgetPassword.com</title>
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
    <h1>Verification</h1>
    <p id="error-message"></p>
    <!-- <form id="form" method="POST">
  <button type="genrate"> Generate Token</button>
  </form> -->
    <form id="form" method="POST">
    <div>
    <label for="ran-input">
          <span>@</span>
        </label>
	     <input type="text" name="key" id="key-input" placeholder="key" value="<?php echo htmlspecialchars($randomInt); ?>" /> >
      </div>
      <div>
    <label for="otp-input">
          <span>@</span>
        </label>
	     <input type="text" name="otp" id="key-input" placeholder="opt">
      </div>

    <button type="submit">Match token</button>
</form>
<p>Back to login <a href="login.php">login</a> </p>
<p>Back to signup <a href="STFS.php">Signup</a> </p>
</div>
<!-- <form id="form" method="POST">
  <button type="genrate"> Generate Token</button>
  </form> -->
</body>
</html>
