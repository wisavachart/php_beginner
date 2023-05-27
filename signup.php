<?php
 require "function.php";
 if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $date = date('Y-m-d H:i:s');
    $query = "insert into users (username,email,password,date) values ('$username','$email','$password','$date')";
    $result = mysqli_query($con, $query);
    header("Location: login.php");
    die;
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up my website</title>
</head>

<body>
    <?php require "header.php";?>
    <form action="" method="post"
        style="margin: 0 auto; padding: 10px;  display: flex; flex-direction: column; width: 350px;">
        <h3>Sign up</h3>
        <input type="text" name="username" placeholder="Username" require><br>
        <input type="email" name="email" placeholder="Email" require><br>
        <input type="text" name="password" placeholder="Password" require><br>
        <button>Signup</button>
        <button>Signup</button>
    </form>
    <?php require "footer.php";?>

</body>

</html>