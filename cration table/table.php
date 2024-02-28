<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        ::-webkit-scrollbar{
width:0
    }
        body{
            background-color:#F6E4AE;
        }
        .all{
            width:100vw;height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    text-align:center;
        }
    </style>
</head>
<body>
    <form class="all" method="POST"> 
    Table Name: <input type="text" name="tableName" >
        <br><br>
        Column 1: <input type="text" name="column1">
        <br><br>
        Column 2: <input type="text" name="column2" >
        <br><br>
        Column 3: <input type="text" name="column3">
        <br><br>
        Column 4: <input type="text" name="column4">
        <br><br>
<input type="submit" name="submit" value="submit">
    </form>

<?php
$tableName = $column1 = $column4 = $column3 = $column2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tableName = test_input($_POST["tableName"]);
  $column1 = test_input($_POST["column1"]);
  $column2 = test_input($_POST["column2"]);
  $column3 = test_input($_POST["column3"]);
  $column4 = test_input($_POST["column4"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(isset($_POST['submit'])){
try {
  $conn = new PDO("mysql:host=localhost;dbname=amine", "root", "");
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to create table
  $sql = "CREATE TABLE $tableName (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    $column1 VARCHAR(30) NOT NULL,
    $column2 VARCHAR(30) NOT NULL,
    $column3 VARCHAR(50),
    $column4 VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Table MyGuests created successfully";
} catch(PDOException $e) {
  echo "erore" ."<br>" . $e->getMessage();
}
}

$conn = null;
?>
</body>
</html>