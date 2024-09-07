<?php
//phpinfo();
//echo "Script is running.";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fn=$_POST["Company_Name"];
    $mob=$_POST["MobileNo"];
    $add=$_POST["Company_Address"];
    $em=$_POST["Email"];
    $pass=$_POST["Password"];
    $rpass =$_POST["repeat-password"];
    //hashing the  value before storing
    // $fn = hash('md5' , $fn);
//     $mob = hash('md5' , $mob);
  //   $add = hash('md5' , $add);
    // $em = hash('md5' , $em);
     $pass = hash('md5' , $pass);
     $rpass = hash('md5' , $rpass);
    $string = $mob;
if(strlen($string)<10){
 ?> <script> alert("Fill correct  mobile number");</script> <?php
}else{
$csvFile ="/var/www/html/data.csv"; 

// Check if the file exists
if (!file_exists($csvFile)) {
    die('File not found');
}

// Initialize an array to hold user data
$users = [];

// Open the CSV file for reading
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Read the header row
//   echo"chanchal";
    $header = fgetcsv($handle);
    
    // Read each line of the CSV file
    while (($data = fgetcsv($handle)) !== FALSE) {
        // Map CSV data to associative array
        $users[] = [
            'Email'    => $data[3]
           // 'Password' => $data[4],
        ];
    }
    fclose($handle);
} else {
    die('Failed to open the file');
}

// Get the user input from the POST request
$userEmail = isset($_POST['Email']) ? trim($_POST['Email']) : '';
//$userPassword = isset($_POST['Password']) ? trim($_POST['Password']) : '';

//$userEmail = hash('md5', $userEmail);
//$userPassword = hash('md5', $userPassword);
// Sanitize user input
$userEmail = htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8');
//$userPassword = htmlspecialchars($userPassword, ENT_QUOTES, 'UTF-8');

// Flag to check if user credentials are valid
//$isValid = false;

// Check if the user input matches any record in the CSV data
foreach ($users as $user) {
 
    if ($user['Email'] === $userEmail) {
      ?> <script> alert("Account already exit!!!"); </script> <?php
 //      echo"chanchal";
    } else {
      // Define the file name
$filename = "/var/www/html/data.csv";
//echo"file open";
// Open the file for writing
$file = fopen($filename , 'w');

// Check if the file opened successfully
if ($file === false) {
    die('Error opening file for writing.');
}

// Define column names
$columns = ['Company_Name', 'MobileNo','Company_Address','Email', 'Password','repeat-password'];

// Write the column names to the file
fputcsv($file, $columns);


$data = [
    ['Company_Name' => $fn,'MobileNo' => $mob, 'Company_Address' => $add,'Email'=> $em, 'Password' =>$pass , 'repeat-password'=>$rpass]
//     ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'age' => 25],
];
// Write each row of data
foreach($data as $row){
  // Extract values in the order of column names
  $rowData = [];
  foreach ($columns as $column) {
      // Use the column name to get the value from the row array
      $rowData[] = isset($row[$column]) ? $row[$column] : '';
  }
  // Write the row to the CSV file
  fputcsv($file, $rowData);
}

// Close the file handle
fclose($file);

?> <script>alert( "Account created successfully!"); </script> <?php
      header("location:http://192.168.1.44/login.php");    
}
}
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
            color:black;
            margin-left: 20px;
            font-size:24px;
            font-weight: bold;
        }
        .header a:hover {
            text-decoration: none;
        }
        h1{
          color:Black;
        }
    </style>
</head>

<body>
  
<header class="header">
        <a href="STFS.php">Signup</a>
        <a href="login.php">Login</a>

        <a href="logout.php">Logout</a>
    </header>
   
  <div class="wrapper">
    <h1>Register</h1>
    <p id="error-message"></p>
    <form id="form" method="POST">
      <div>
        <label for="company-input">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 0C21.5 0 0 21.5 0 48L0 464c0 26.5 21.5 48 48 48l96 0 0-80c0-26.5 21.5-48 48-48s48 21.5 48 48l0 80 96 0c26.5 0 48-21.5 48-48l0-416c0-26.5-21.5-48-48-48L48 0zM64 240c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zm112-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM80 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32zM272 96l32 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16z"/></svg>
	</label>
	<input type="text" name="Company_Name" id="company-input" placeholder="Company_Name" required>
      </div>
      
      <div>
	<label for="mob-input">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
	</label>
	<input type="text" name="MobileNo" id="mob-input" placeholder="MobileNo" required>
	</div>
	
	<div>
	<label for="Address-input">
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>
	</label>
	<input type="text" name="Company_Address" id="Address-input" placeholder="Comapny_Address" required>
	</div>
	
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="Email" id="email-input" placeholder="Email" required>
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="Password" id="password-input" placeholder="Password" required>
      </div>
      <div>
        <label for="repeat-password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="repeat-password" id="repeat-password-input" placeholder="Confirm  Password" required>
      </div>
      <button type="submit">Signup</button>
    </form>
    <p>Already have an Account? <a href="login.php">login</a> </p>
  </div>
</body>
</html>

