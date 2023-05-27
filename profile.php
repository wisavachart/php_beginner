<?php
   
 require "function.php";
 check_login();
 if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST["username"]) ) {
    //profile edit 
    $image_added = false;
    if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        // file was upload
        $folder = "uploads/";
        if(!file_exists($folder)) {
            mkdir($folder,0777,true);
        }
        $image = $folder .$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$image);
        if (file_exists($_SESSION["logged"]["image"])){
            unlink($_SESSION["logged"]["image"]);
        }
        $image_added = true;
    }
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $id = $_SESSION["logged"]["id"];
    if($image_added == true) {
        $query = "update users set username = '$username' , email = '$email' , password = '$password' , image = '$image'  where id = '$id' limit 1"; 
    } else {
        $query = "update users set username = '$username' , email = '$email' , password = '$password' where id = '$id' limit 1"; 
    }

    $result = mysqli_query($con, $query);
    $query = "select * from users where id = '$id' limit 1";
    $result = mysqli_query($con, $query); 
    if (mysqli_num_rows( $result) > 0) {
        $_SESSION["logged"] = mysqli_fetch_assoc( $result);
    }
    header("Location: profile.php");
    die;
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile website</title>
</head>

<body>
    <?php require "header.php";?>
    <div class="chk">
        <?php if (!empty($_GET["action"]) && $_GET["action"] == 'edit'):?>
        <div>
            <form method="post" enctype="multipart/form-data"
                style="margin: 0 auto; padding: 10px;  display: flex; flex-direction: column; width: 350px;">
                <h3>edit profile</h3>
                <img src="<?php echo $_SESSION["logged"]["image"]?>" alt=""
                    style="width: 150px; height:150px; object-fit: cover;">
                image : <input type="file" name="image"><br>
                <input value="<?php echo $_SESSION["logged"]["username"]?>" type="text" name="username"
                    placeholder="Username" require><br>
                <input value="<?php echo $_SESSION["logged"]["email"]?>" type="email" name="email" placeholder="Email"
                    require><br>
                <input value="<?php echo $_SESSION["logged"]["password"]?>" type="text" name="password"
                    placeholder="Password" require><br>

                <button>save</button>
                <a href="profile.php">
                    <button type="button">cancel</button>
                </a>
            </form>
        </div>
        <?php else :?>
        <h3>User Profile</h3>
        <table style="text-align: center;">
            <tr>
                <td><img src="<?php echo $_SESSION["logged"]["image"]?>" alt=""
                        style="width: 150px; height:150px; object-fit: cover;"></td>
            </tr>
            <tr>
                <td><?php echo $_SESSION["logged"]["username"];?></td>
            </tr>
            <tr>
                <td><?php echo $_SESSION["logged"]["email"];?></td>
            </tr>
        </table>
        <a href="profile.php?action=edit">
            <button>edit profile</button>
        </a>
        <hr>
        <h5>Create a post</h5>
        <form action="" method="post"
            style="margin: 0 auto; padding: 10px;  display: flex; flex-direction: column; width: 350px;">

            <textarea name="post" rows="8"></textarea><br>
            <button>Post</button>
        </form>
        <?php endif ;?>
    </div>
    <?php require "footer.php";?>

</body>

</html>