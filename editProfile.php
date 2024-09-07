<?php
$csvFile = "/var/www/html/data.csv";


// Define the path to the CSV file
$filePath = '/var/www/html/data.csv';

// Initialize an array to store data
$dataArray = [];

// Open the CSV file for reading
if (($handle = fopen($filePath, 'r')) !== FALSE) {
    // Read each line of the CSV file
    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        // Store each row of data in the array
        $dataArray[] = $data;
    }
    // Close the file handle
    fclose($handle);
} else {
    die('Error: Unable to open the CSV file.');
}

// Assume $dataArray is already populated with CSV data
foreach ($dataArray as $row) {
    // Check if the row has the expected number of columns
    if (count($row) >= 6) {
        // Assign each column value to a separate variable
        $fn = $row[0];
        $mob = $row[1];
        $add = $row[2];
        $em = $row[3];
        $pass = $row[4];
         $rpass = $row[5];
        
    } 
}

//phpinfo();
//echo "Script is running.";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fn=$_POST["Company_Name"];
    $mob=$_POST["MobileNo"];
    $add=$_POST["Company_Address"];
    $em=$_POST["Email"];
    //hashing the  value before storing
    //$fn = hash('md5' , $fn);
    // $mb = hash('md5' , $mob);
  //   $ad = hash('md5' , $add);
//     $eml = hash('md5' , $em);
    
    
      // Define the file name
$filename = "/var/www/html/data.csv";

// Open the file for writing
$file = fopen($filename , 'w');

// Check if the file opened successfully
if ($file === false) {
    die('Error opening file for writing.');
}

// Define column names
$columns = ['Company_Name', 'MobileNo','Company_Address','Email','Password','repeat-Password'];

// Write the column names to the file
fputcsv($file, $columns);

$data = [
    ['Company_Name' => $fn,'MobileNo' => $mob, 'Company_Address' => $add,'Email'=> $em, 'Password' => $pass ,'repeat-Password'=> $rpass]
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

?> <script>alert( "Data updated successfully!"); </script> <?php

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
     body{
      min-height: 100vh;

  color:black;
  font-size:18px;
  font-weight: bold;
}
    .header {
        background-color: transperent;
        padding: 2px 250px;
        width:100%;
        
        display: flex;
        justify-content: flex-end;
    }
    .header a {
        text-decoration: none;
        color: Black;
        margin-left: 20px;
        font-size:24px;
        font-weight: bold;
    }
    .header a:hover {
        text-decoration: none;
    }
    h1{
      color:white;
    }
</style>
</head>
<body>
 
<header class="header">
        <a href="STFS.php">Signup</a>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
    </header>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <ul class="list-group">
        <li class="list-group-item"> <a href="#profiledetails" data-toggle="tab" class="list-group-item-action" > Profile Details   </a> </li>
        <li class="list-group-item"> <a href="#edit" data-toggle="tab" class="list-group-item-action">  Edit Profile </a> </li>
        <li  class="list-group-item"> <a href="logout.php"  class="list-group-item-action"> logout </a> </li>
      </ul>
   </div>
   <div class="col-md-9">
    <div class="tab-content">
      <div class="tab-pane" id="profiledetails">
         <table class="table">
          <tr>
            <td>Company Name</td>
            <td><input value=" <?php echo htmlspecialchars($fn); ?>"></td>
          </tr> 
          <tr>
            <td>Mobile No.</td>
            <td><input value="<?php echo htmlspecialchars($mob); ?>"></td>
          </tr>
          <tr>
            <td>Company Address</td>
            <td><input value="<?php echo htmlspecialchars($add); ?>"></td>
          </tr>
          <tr>
            <td>Email ID</td>
            <td><input value="<?php echo htmlspecialchars($em); ?>"></td>
          </tr>
         </table>
      </div>
      <div class="tab-pane" id="edit">
      <div class="wrapper">
      <form method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Company Name</label>
    <input type="text" class="form-control" name="Company_Name" id="exampleInputEmail1" aria-describedby="emailHelp"value="<?php echo htmlspecialchars($fn); ?>">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Mobile No</label>
    <input type="text" class="form-control" name="MobileNo" id="exampleInputEmail1" aria-describedby="emailHelp"value="<?php echo htmlspecialchars($mob); ?>">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Company address</label>
    <input type="text" class="form-control"  name="Company_Address" id="exampleInputEmail1" aria-describedby="emailHelp"value="<?php echo htmlspecialchars($add); ?>">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="Email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($em); ?>">
   
  </div>
  
  <button type="submit" class="btn btn-primary">Update</button>
</form>
      </div>
      </div>
    </div>

   </div>
  </div>
</div>
</body>
</html>
