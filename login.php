<?php
   
 require "function.php";

 if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $emailerror ="";
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    

    $query = "select * from users where email = '$email' && password = '$password' limit 1";
    $result = mysqli_query($con, $query);

    
    if(mysqli_num_rows($result) > 0 ) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["logged"] = $row; 
        // print_r($row);
        header("Location: profile.php");
        die;    
    } else {
        $error = "wrong email or password";
    }
    
 }
 if(empty($email)) {
    $emailerror ="ควยไม่กรอก";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login my website</title>
</head>

<body>
    <?php require "header.php";?>
    <?php 
    if(!empty($error)) {
        echo "<div>" .$error."</div>";
    }
    ?>

    <form action="" method="post"
        style="margin: 0 auto; padding: 10px;  display: flex; flex-direction: column; width: 350px;">
        <h3>Login</h3>
        <input type="email" name="email" placeholder="Email" require><br>
        <input type="text" name="password" placeholder="Password" require><br>
        <button>Login</button>

    </form>
    <?php require "footer.php";?>

</body>

</html>