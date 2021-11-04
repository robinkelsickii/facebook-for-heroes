<?php
function connectDb(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql-heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "first connect";
}
connectDb(); 

$action = $_GET["action"];

function createHero($name, $about_me, $bio){
echo "in create"; 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql-heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "INSERT INTO heroes (name, about_me, biography)
    VALUES ('$name', '$about_me', '$bio')";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo  $name . $about_me . $bio;
    mysqli_close($conn);
}


function readHero(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql-heroes";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM heroes";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "name: " . $row["name"] . " about_me: " . $row["about_me"]. " " . $row["biograohy"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
}

switch ($action) {
  case "create":
  createHero($_POST["name"], $_POST["about_me"], $_POST["bio"]);
    echo "Your favorite color is red!";
    break;
  case "read":
  readHero();
    echo "Your favorite color is blue!";
    break;
  case "update":
    echo "Your favorite color is green!";
    break;
    case "delete":
    echo "Your favorite color is green!";
    break;
  default:
    echo "Your favorite color is neither red, blue, nor green!";
}

?>
