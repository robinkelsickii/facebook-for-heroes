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
// echo "first connect";
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
    echo "name: " . $row["name"] . " about_me: " . $row["about_me"]. " " . $row["biography"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);
}

function updateHero($name, $about_me, $bio, $id){
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

$sql = "UPDATE heroes SET name='$name',about_me='$about_me',biography='$bio' WHERE heroes.id=$id"; 

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo  $name . $about_me . $bio;
    mysqli_close($conn);
} 

function deleteHero($id){
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

    // sql to delete a record
    $sql = "DELETE FROM heroes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}

switch ($action) {
  case "create":
  createHero($_POST["name"], $_POST["about_me"], $_POST["bio"]);
    echo "Hero has been created";
    break;
  case "read":
  readHero();
    echo "These are the Heroes";
    break;
  case "update":
  updateHero($_POST["name"], $_POST["about_me"], $_POST["bio"], $_POST["id"]); 
    echo $name + "has been updated";
    break;
    case "delete":
    deleteHero($_GET["id"]);
    echo "Hero has been deleted";
    break;
  default:
        http_response_code(404);
        echo "Not found.";
}
?>
