<?php

session_start();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Profile</title>
</head>
<header>
    <nav class="navbar bg-warning">
        <h1 class="text-dark">User page</h1>
        <div>

            <?php

            if (($_SESSION["id"] == null) && ($_SESSION["role"] == null)) {
                echo "<a class='btn btn-light' href='login.php'>Login</a> ";
                echo "<a class='btn btn-dark' href='signup.php'>Sign up</a>";
            } else {
                $id = $_SESSION["id"];
                $username = $_SESSION['user_name'];
                echo "<h4 class='text-dark'>$username</h4>";
                echo "<a class='btn btn-light' href='profile.php?id=$id'>My Profile</a> ";
                echo "<a class='btn btn-danger' href='logout.php'>Logout</a>";
            }

            ?>
        </div>
    </nav>
</header>
<body class="container-sm p-10">

<h1>Profile</h1>
<?php
$array = array();
parse_str($_SERVER['QUERY_STRING'], $array);
$id = $array["id"];

$servername = "localhost";
$username = "root";
$password = "160802anna";
$dbname = "laba2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM users LEFT JOIN roles ON users.role_id=roles.role_id WHERE id='$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$_SESSION["first_name"] = $row["first_name"];
$_SESSION["last_name"] = $row["last_name"];
$_SESSION["email"] = $row["email"];
$_SESSION["clicked_role"] = $row["role_name"];
$_SESSION["clicked_id"] = $id;
$_SESSION["profile_photo"] = $row["img"];
?>
<?php
echo "<img width=100 height=150 src=". $_SESSION['profile_photo'] . ">";
if($_SESSION["clicked_id"] == $_SESSION["id"]) {
    echo  "<form action='upload_image.php' method='post' enctype='multipart/form-data'>
            Select image to upload:
        <input type='file' name='fileToUpload'' id='fileToUpload'>
        <input type='submit' value='Upload Image' name='submit'>
    </form>";
}


?>
<form action="update_user.php" method="post">
    <div class="form-group">
        <label for="formGroupExampleInput">First Name</label>
        <input type="text"
               name="first_name" <?php if ($_SESSION["id"] != $_SESSION["clicked_id"] && $_SESSION["role"] != "admin") echo "readonly" ?>
               class="form-control" id="formGroupExampleInput" placeholder="First Name"
               value="<?php echo $_SESSION["first_name"] ?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Last name</label>
        <input type="text"
               name="last_name" <?php if ($_SESSION["id"] != $_SESSION["clicked_id"] && $_SESSION["role"] != "admin") echo "readonly" ?>
               class="form-control" id="formGroupExampleInput2" placeholder="Last Name"
               value="<?php echo $_SESSION["last_name"] ?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Email</label>
        <input type="text"
               name="email" <?php if ($_SESSION["id"] != $_SESSION["clicked_id"] && $_SESSION["role"] != "admin") echo "readonly" ?>
               class="form-control" id="formGroupExampleInput2" placeholder="Email"
               value="<?php echo $_SESSION["email"] ?>">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Role</label>
        <input type="text"
               readonly <?php if ($_SESSION["id"] != $_SESSION["clicked_id"] && $_SESSION["role"] != "admin") echo "readonly" ?>
               class="form-control" id="formGroupExampleInput2" value="<?php echo $_SESSION["clicked_role"] ?>">
    </div>
    <div class="form-group">
        <button type="submit" <?php if ($_SESSION["id"] != $_SESSION["clicked_id"] && $_SESSION["role"] != "admin") echo "disabled" ?>
                class="btn btn-warning">Update
        </button>
    </div>
</form>
<a href="homepage.php" class="text-primary">go home</a>
<?php

if ($_SESSION["role"] == "admin" && $_SESSION["clicked_role"] != "admin") {
    $id = $_SESSION["clicked_id"];
    echo "<a href='delete_user.php?id=$id' class='text-danger' onclick='checkIfReady()'>delete user</a>";
} ?>
</body>
<script>
    function checkIfReady() {
        if(!confirm("Are you sure?")) {
            return false;
        } else {
            return true;
        }
    }
</script>
</html>
