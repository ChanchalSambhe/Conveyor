
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
 // $em=$_POST["Email"];
 // $pass=$_POST["Password"];
 
$filePath = "/var/www/html/data.csv"; // Path to your CSV file

// Define the path to the CSV file
$csvFile = "/var/www/html/data.csv"; 

// Check if the file exists
if (!file_exists($csvFile)) {
    die('File not found');
}

// Initialize an array to hold user data
$users = [];

// Open the CSV file for reading
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // Read the header row
    $header = fgetcsv($handle);
    
    // Read each line of the CSV file
    while (($data = fgetcsv($handle)) !== FALSE) {
        // Map CSV data to associative array
        $users[] = [
            'Email'    => $data[3],
            'Password' => $data[4],
        ];
    }
    fclose($handle);
} else {
    die('Failed to open the file');
}

// Get the user input from the POST request
$userEmail = isset($_POST['Email']) ? trim($_POST['Email']) : '';
$userPassword = isset($_POST['Password']) ? trim($_POST['Password']) : '';

//$userEmail = hash('md5', $userEmail);
$userPassword = hash('md5', $userPassword);
// Sanitize user input
$userEmail = htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8');
$userPassword = htmlspecialchars($userPassword, ENT_QUOTES, 'UTF-8');

// Flag to check if user credentials are valid
//$isValid = false;

// Check if the user input matches any record in the CSV data
foreach ($users as $user) {
 
    if ($user['Email'] === $userEmail && $user['Password'] === $userPassword) {
      ?> <script> alert("Login successful!"); </script> <?php
      header("location:http://192.168.1.61:1880/ui");
    } else {
      ?> <script> alert( "Invalid email or password."); </script> <?php
    }
}

// Output the result
// if ($isValid) {
//     "Login successful!"); </script> <?php
// } else {
//    "Invalid email or password."); </script> <?php
// }
}
?>
<!-- 
// // Define the path to the CSV file
// //$csvFile = 'data.csv';

// // Check if the file exists
// if (!file_exists($filePath)) {
//     die('File not found');
// }

// // Initialize an array to hold CSV data
// $csvData = [];

// // Open the CSV file for reading
// if (($handle = fopen($filePath, 'r')) !== FALSE) {
//     // Read each line of the CSV file
//     while (($data = fgetcsv($handle)) !== FALSE) {
//         // Assuming each row is a single value, add it to the array
//         $csvData[] = $data[0];
//     }
//     fclose($handle);
// } else {
//     die('Failed to open the file');
// }

// // Get the user input from the POST request
// $userInput = isset($_POST['submit']) ? trim($_POST['submit']) : '';

// // Sanitize user input
// $userInput = htmlspecialchars($userInput, ENT_QUOTES, 'UTF-8');

// // Check if the user input exists in the CSV data
// if (in_array($userInput, $csvData)) {
//    ?> <script> alert("The data exists in the CSV file."); </script> 
// } else {
//   ? <script> alert( "The data does not exist in the CSV file."); </script> <
// }
// }
// ?>

 Check if the file exists
if (file_exists($filePath)) {
    // Open the CSV file for reading
    if (($file = fopen($filePath, "r")) !== FALSE) {
        // Output the contents of the file
        echo "<table border='1'>";
        $firstRow = true;
        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            // Print the header row
            if ($firstRow) {
                echo "<tr>";
                foreach ($data as $header) {
                    echo "<th>" . htmlspecialchars($header) . "</th>";
                }
                echo "</tr>";
                $firstRow = false;
            } else {
                // Print the data rows
                echo "<tr>";
                foreach ($data as $field) {
                    echo "<td>" . htmlspecialchars($field) . "</td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";

        // Close the file
        fclose($file);
    } else {
        echo "Error opening file.";
    }
} else {
    echo "File does not exist.";
}
}
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
    <h1>Login</h1>
    <p id="error-message"></p>
    <form id="form" method="POST">
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="Email" id="email-input" placeholder="Email">
      </div>
      <div>
        <label for="password-input">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm240-200q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80Z"/></svg>
        </label>
        <input type="password" name="Password" id="password-input" placeholder="Password">
      </div>
      <button type="submit">Login</button>
    </form>
    <p>New here? <a href="STFS.php">Create an Account</a></p>
    <p>Forget password ? <a href="send.php">click here</a></p>
  </div>
  
</body>
</html>
