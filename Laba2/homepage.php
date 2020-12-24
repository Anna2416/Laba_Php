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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js" defer></script>
    <title>Users</title>
</head>
<header>
    <nav class="navbar bg-warning">
        <h1 class="text-dark">User page</h1>
        <div>

            <?php

            if (($_SESSION["id"] == null) && ($_SESSION["role"] == null)) {
                echo "<a class='btn btn-light' id='login-btn'>Login</a> ";
                echo "<a class='btn btn-dark' id='signup-btn'>Sign up</a>";
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
<body>
<div class="backdrop not"></div>
<div class="login not" id="login-div">
    <form action="process.php" method="post" class="bg-light p-5 rounded">
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" name="login" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <input type="submit" class="btn btn-primary" value="Login" />
        <a class="btn btn-danger" id="close-btn">Close</a>
    </form>
</div>
<div class="signup not" id="signup-div">
    <form action="register.php" class="needs-validation bg-light rounded p-5" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">First name</label>
            <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last name</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" name="login" class="form-control" id="exampleInputEmail1" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" minlength="6" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Roles</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="role_id" required>
                <option value="2">admin</option>
                <option value="1" selected>user</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
        <a class="btn btn-danger" id="close-signup">Close</a>
    </form>
</div>
<div class="container">
    <table class="table table-light table-hover">
        <thead class="thead-light">
        <th scope="col">
            Id
        </th>
        <th scope="col">
            Name
        </th>
        <th scope="col">
            Email
        </th>
        <th scope="col">
            Role
        </th>
        </thead>
        <tbody>
        <?php
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

        $sql = "SELECT * FROM users LEFT JOIN roles ON users.role_id=roles.role_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $img = $row['img'];
                $id = $row["id"];
                echo "<tr " . "onclick=" . "checkItem(" . "$id" . ")>";
                echo "<td>" . $row["id"] . "</td>." . "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>" . "<td>" . $row["email"] . "</td>" . "<td>" . $row["role_name"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><tr>empty</tr><tr>empty</tr><tr>empty</tr><tr>empty</tr></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
<script>
    function checkItem(param) {
        location.replace("/Laba2/profile.php?id=" + param);
    }
</script>
</html>
